<?php

namespace LaravelAcl\Authentication\Controllers;

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use view,
    DB,
    App,
    Redirect,
    Config,
    Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use LaravelAcl\Authentication\Exceptions\PermissionException;
use LaravelAcl\Authentication\Exceptions\ProfileNotFoundException;
use LaravelAcl\Authentication\Helpers\DbHelper;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserPresenter;
use LaravelAcl\Authentication\Services\UserProfileService;
use LaravelAcl\Authentication\Validators\UserProfileAvatarValidator;
use LaravelAcl\Library\Exceptions\NotFoundException;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Helpers\FormHelper;
use LaravelAcl\Authentication\Exceptions\UserNotFoundException;
use LaravelAcl\Authentication\Validators\UserValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Validators\UserProfileValidator;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use App\Http\Models\CmsPage;
use App\Repositories\CmsPageRepository;
use App\PageTemplates;

class PagesController extends Controller
{

    protected $auth;
    protected $logged_user;
    protected $pagerepository;

    public function __construct(AuthenticateInterface $auth, CmsPageRepository $cmsPageRepo)
    {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->pagerepository = $cmsPageRepo;
    }

    public function getList(Request $request)
    {

        $results = $this->pagerepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.cms.page.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request)
    {
        if (isset($request->page) && !empty($request->page)) {
            $page = $request->page;
        } else {
            $page = 'home';
        }

        $field = $this->getHtml($page);
        return View::make('laravel-authentication-acl::admin.cms.page.new')->with(['user_data' => $this->logged_user, 'template' => $this->getTemplates(), 'fields' => $field, 'select_page'=>$page]);
    }

    public function postNew(Request $request)
    {
        $this->validate($request,
            ['name' => 'required', 'template' => 'required|unique:cms_pages', 'title' => 'required', 'banner_type' => 'required']);

        $fields = $this->getField($request->except(['_token', 'redirect_after_save', 'id']));
        $fields['slug'] = $this->getNewSlug($fields['title'], $fields['slug']);

        try {
            $insert_id=$this->pagerepository->create($fields);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("page.new", [])->withInput()->withErrors($errors);
        }

        if($request->redirect_after_save=='edit'){
            $base=route('page.'.$request->redirect_after_save);
            $editmode=$base."?id=$insert_id->id";
            return Redirect($editmode)->withMessage(Config::get('acl_messages.flash.success.cms_page_edit_success'));
        }


        return Redirect::route('page.' . $request->redirect_after_save)->withMessage(Config::get('acl_messages.flash.success.cms_page_new_success'));
    }

    public function getUpdate(Request $request)
    {

        if (isset($request->page) && !empty($request->page)) {
            $page = $request->page;
        } else {
            $page = 'home';
        }

        $field = $this->getHtml($page);
        $result = $this->pagerepository->find($request->id);
        $extras = json_decode($result['extras'], TRUE);
        $result = (Object)array_merge($result['original'], $extras);
        return View::make('laravel-authentication-acl::admin.cms.page.edit')->with(['data' => $result, 'template' => $this->getTemplates(), 'fields' => $field, 'select_page'=>$page]);
    }

    public function postUpdate(Request $request)
    {

        $this->validate($request,
            ['name' => 'required', 'template' => 'required', 'title' => 'required', 'banner_type' => 'required']);

        $fields = $this->getField($request->except(['_token', 'redirect_after_save', 'id']));
        $fields['slug'] = $this->getUpdateSlug($fields['title'], $fields['slug'], $request->id);

        try {
            $this->pagerepository->update($request->id, $fields);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("page.edit", [])->withInput()->withErrors($errors);
        }
        if($request->redirect_after_save=='edit'){
            $base=route('page.'.$request->redirect_after_save);
            $editmode=$base."?id=$request->id";
            return Redirect($editmode)->withMessage(Config::get('acl_messages.flash.success.cms_page_edit_success'));
        }
        return Redirect::route('page.' . $request->redirect_after_save)->withMessage(Config::get('acl_messages.flash.success.cms_page_edit_success'));
    }

    public function delete(Request $request)
    {
        $this->pagerepository->delete($request->id);
        return Redirect::route('page.list')->withMessage(Config::get('acl_messages.flash.success.cms_page_delete_success'));
    }

    public function getTemplates()
    {
        $template = new PageTemplates();
        $templates = get_class_methods($template);
        unset($templates[0]);
        unset($templates[1]);
        $templatesVal=Array();
        foreach($templates as $key=>$val){
            $templatesVal[$key]=ucwords(str_replace('_', ' ', $val));
        }
        $templates = array_combine($templates, $templatesVal);
        return $templates;
    }

    private function getField($objects)
    {
        $page = new CmsPage();
        $fillable = $page->getFillable();
        $fields = Array();
        $extra_fields = Array();
        foreach ($objects as $key => $val) {
            if (in_array($key, $fillable)) {
                $fields[$key] = $val;
            } else {
                $extra_fields['extras_fields'][$key] = $val;
            }
        }
        $fields['extras'] = json_encode($extra_fields['extras_fields']);
        return $fields;
    }

    private function getNewSlug($title, $slug)
    {
        $page = new CmsPage();
        $slug = $page->getSlugOrTitleAttribute($title, $slug);
        $slugInfo = $page->where('slug', $slug)->get();
        $i = count($slugInfo);
        if ($i === 0) {
            return $slug;
        }
        $i = 1;
        for ($i; $i <= 10000000; $i++) {
            $finalSlug = $slug . '-' . $i;
            $j = count($page->where('slug', $finalSlug)->get());
            if ($j == 0) {
                $i = 10000000;;
            }
        }
        return $finalSlug;
    }

    private function getUpdateSlug($title, $slug, $id)
    {
        $page = new CmsPage();
        $slug = $page->getSlugOrTitleAttribute($title, $slug);
        $slugInfo = $page->where([['slug', $slug], ['id', '<>', $id]])->get();
        $i = count($slugInfo);
        if ($i === 0) {
            return $slug;
        }
        $i = 1;
        for ($i; $i <= 10000000; $i++) {
            $finalSlug = $slug . '-' . $i;
            $j = count($page->where([['slug', $finalSlug], ['id', '<>', $id]])->get());
            if ($j == 0) {
                $i = 10000000;
            }
        }
        return $finalSlug;
    }

    public function getHtml($page)
    {
        $template = new PageTemplates();
        $FormElement = $template->getArray($page);
        return $FormElement;
    }
}
