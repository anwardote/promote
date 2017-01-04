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
use App\Http\Models\CmsPost;
use App\Repositories\CmsPostRepository;

class PostsController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $cmsPostRepository;

    public function __construct(AuthenticateInterface $auth, CmsPostRepository $postRepository) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->cmsPostRepository = $postRepository;
    }
    public function getList(Request $request) {
        $results = (Object) $this->cmsPostRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.cms.post.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        return View::make('laravel-authentication-acl::admin.cms.post.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request) {

        $this->validate($request,
            ['cms_category_id' => 'required', 'title' => 'required', 'status' => 'required']);

        $fields = $request->except(['_token', 'redirect_after_save', 'id']);
        $fields['slug'] = $this->getNewSlug($fields['title'], $fields['slug']);
        try {
            $insert_id=$this->cmsPostRepository->create($fields);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("post.new", [])->withInput()->withErrors($errors);
        }

        if($request->redirect_after_save=='edit'){
            $base=route('post.'.$request->redirect_after_save);
            $editmode=$base."?id=$insert_id->id";
            return Redirect($editmode)->withMessage(Config::get('acl_messages.flash.success.cms_page_edit_success'));
        }
        return Redirect::route('post.'.$request->redirect_after_save)->withMessage(Config::get('acl_messages.flash.success.cms_post_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->cmsPostRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.cms.post.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request) {

        $this->validate($request,
            ['cms_category_id' => 'required', 'title' => 'required', 'status' => 'required']);
        $fields = $request->except(['_token', 'redirect_after_save', 'id']);
        $fields['slug'] = $this->getUpdateSlug($fields['title'], $fields['slug'], $request->id);

        try {
            $this->cmsPostRepository->update($request->id, $fields);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("post.edit", [])->withInput()->withErrors($errors);
        }
        if($request->redirect_after_save=='edit'){
            $base=route('post.'.$request->redirect_after_save);
            $editmode=$base."?id=$request->id";
            return Redirect($editmode)->withMessage(Config::get('acl_messages.flash.success.cms_post_edit_success'));
        }
        return Redirect::route('post.'.$request->redirect_after_save)->withMessage(Config::get('acl_messages.flash.success.cms_post_edit_success'));
    }

    public function delete(Request $request) {
        $this->cmsPostRepository->delete($request->id);
        return Redirect::route('post.list')->withMessage(Config::get('acl_messages.flash.success.cms_post_delete_success'));
    }

    private function getNewSlug($title, $slug)
    {
        $post = new CmsPost();
        $slug = $this->getSlugOrTitleAttribute($title, $slug);
        $slugInfo = $post->where('slug', $slug)->get();
        $i = count($slugInfo);
        if ($i === 0) {
            return $slug;
        }
        $i = 1;
        for ($i; $i <= 10000000; $i++) {
            $finalSlug = $slug . '-' . $i;
            $j = count($post->where('slug', $finalSlug)->get());
            if ($j == 0) {
                $i = 10000000;;
            }
        }
        return $finalSlug;
    }

    private function getUpdateSlug($title, $slug, $id)
    {
        $post = new CmsPost();
        $slug = $this->getSlugOrTitleAttribute($title, $slug);
        $slugInfo = $post->where([['slug', $slug], ['id', '<>', $id]])->get();
        $i = count($slugInfo);
        if ($i === 0) {
            return $slug;
        }
        $i = 1;
        for ($i; $i <= 10000000; $i++) {
            $finalSlug = $slug . '-' . $i;
            $j = count($post->where([['slug', $finalSlug], ['id', '<>', $id]])->get());
            if ($j == 0) {
                $i = 10000000;
            }
        }
        return $finalSlug;
    }

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrTitleAttribute($title, $slug)
    {
        $title = strtolower($title);
        $slug = strtolower($slug);

        if ($slug != '') {
            return str_replace(' ', '_', $slug);
        }

        return \Str::slug($title, '-');
    }


}
