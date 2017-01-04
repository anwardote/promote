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
use App\Http\Models\CmsCategory;
use App\Repositories\CmsCategoryRepository;

class CategoriesController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $categoryrepository;

    public function __construct(AuthenticateInterface $auth, CmsCategoryRepository $cmsCategoryRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->categoryrepository = $cmsCategoryRepo;
    }
    public function getList(Request $request) {
        $results = $this->categoryrepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.cms.category.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        return View::make('laravel-authentication-acl::admin.cms.category.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request) {
        $this->validate($request, ['name' => 'required|unique:cms_categories']);
        try {
            $request->merge(array('name' => strtolower($request->name)));
            $input = $request->except(['_token']);
            $this->categoryrepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("category.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('category.list')->withMessage(Config::get('acl_messages.flash.success.cms_category_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->categoryrepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.cms.category.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request) {

       $this->validate($request, ['name' => 'required']);

        try {
            $request->merge(array('name' => strtolower($request->name)));
            $input = $request->except(['_token']);
            $this->categoryrepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("category.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('category.list')->withMessage(Config::get('acl_messages.flash.success.cms_category_edit_success'));
    }

    public function delete(Request $request) {
        $this->categoryrepository->delete($request->id);
        return Redirect::route('category.list')->withMessage(Config::get('acl_messages.flash.success.cms_category_delete_success'));
    }

}
