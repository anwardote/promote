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
use App\Http\Models\ViewCategory;
use App\Repositories\ViewCategoryRepository;

class ViewCategoryController extends Controller
{

    protected $auth;
    protected $logged_user;
    protected $viewCategoryRepository;

    public function __construct(AuthenticateInterface $auth, ViewCategoryRepository $viewCategoryRepo)
    {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->viewCategoryRepository = $viewCategoryRepo;
    }

    public function getAdminList(Request $request)
    {
        $results = $this->viewCategoryRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.view-category.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request)
    {
        return View::make('laravel-authentication-acl::admin.view-category.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['fcategory_id' => 'required', 'title' => 'required|unique:view_categories', 'description' => 'required']);
        try {
            $input = $request->except(['_token']);
            $this->viewCategoryRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("viewcategory.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('viewcategory.list')->withMessage(Config::get('acl_messages.flash.success.viewcategory_new_success'));
    }

    public function getUpdate(Request $request)
    {
        $result = $this->viewCategoryRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.view-category.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request)
    {

        $this->validate($request, ['fcategory_id' => 'required', 'title' => 'required', 'description' => 'required']);

        try {
            $input = $request->except(['_token']);
            $this->viewCategoryRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("viewcategory.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('viewcategory.list')->withMessage(Config::get('acl_messages.flash.success.viewcategory_edit_success'));
    }

    public function delete(Request $request)
    {
        $this->viewCategoryRepository->delete($request->id);
        return Redirect::route('viewcategory.list')->withMessage(Config::get('acl_messages.flash.success.viewcategory_delete_success'));
    }


    /* For CMS Page*/

    public function getFirmwareCategoryView(Request $request)
    {
        $results = $this->viewCategoryRepository->allWhere($request->except(['page']), $request);
        return View::make('admin.pages.firmware-categoryview')->with(['results' => $results, 'request' => $request]);

    }


    public function getDriverCategoryView(Request $request)
    {
        $results = $this->viewCategoryRepository->allWhere($request->except(['page']), $request);
        return View::make('admin.pages.driver-categoryview')->with(['results' => $results, 'request' => $request]);

    }
}
