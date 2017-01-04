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
use App\Http\Models\Driver;
use App\Repositories\DriverRepository;
use App\Repositories\GlobalRepository;
use App\Repositories\ViewCategoryRepository;

class DriversController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $driverRepository;
    protected $globalrepository;
    protected $viewCategoryRepository;

    public function __construct(AuthenticateInterface $auth, DriverRepository $driverRepo, GlobalRepository $globalRepo, ViewCategoryRepository $viewCategoryRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->driverRepository = $driverRepo;
        $this->globalrepository = $globalRepo;
        $this->viewCategoryRepository = $viewCategoryRepo;
    }

    public function getIndex() {
        $info = "welcome to web page";
        return View::make('admin.driver.index')->with(['user_data' => $this->logged_user, 'info' => $info]);
    }

    public function getAdminList(Request $request) {
        $results = $this->driverRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.driver.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        $category=$this->globalrepository->findcatForFirmware([3,3]);
        return View::make('laravel-authentication-acl::admin.driver.new')->with(['user_data' => $this->logged_user, 'view_category' => $category]);
    }

    public function postNew(Request $request) {
        $logged_user = $this->auth->getLoggedUser();

        $downloadLink = implode(",", $request->download_link);
        $request->merge(array('download_link' => $downloadLink));

        $this->validate($request, [ 'driver_id' => 'required','view_category_id'=>'required', 'driver_type' => 'required', 'driver_model' => 'required', 'supports' => 'required', 'status' => 'required', 'download_link' => 'required']);

        /* START custom value set */
        $request->merge(array('d_links' => $request->download_link));
        if (isset($request->driver_type) && count($request->driver_type) > 0) {
            $driverArr = implode(",", $request->driver_type);
            $request->merge(array('driver_type' => $driverArr));
        } else {
            $request->merge(array('driver_type' => null));
        }
        if ($request->tutorial_id == "" || empty($request->tutorial_id)) {
            $request->merge(array('tutorial_id' => NULL));
        }
        if (isset($request->featured) && $request->featured == 1) {
            $request->merge(array('featured' => 1));
        } else {
            $request->merge(array('featured' => 0));
        }
        $request->merge(array('user_id' => $logged_user->id));
        /* START custom value set */

        try {
            $input = $request->except(['_token', 'download_link']);
           // dd($input);
            $this->driverRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("driver.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('driver.list')->withMessage(Config::get('acl_messages.flash.success.driver_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->driverRepository->find($request->id);
        $category=$this->globalrepository->findcatForFirmware([3,3]);
        return View::make('laravel-authentication-acl::admin.driver.edit')->with(['data' => $result, 'view_category'=>$category]);
    }

    public function postUpdate(Request $request) {
        $downloadLink = implode(",", $request->download_link);
        $request->merge(array('download_link' => $downloadLink));

        $this->validate($request, [ 'driver_id' => 'required', 'view_category_id'=>'required','driver_type' => 'required', 'driver_model' => 'required', 'supports' => 'required', 'status' => 'required', 'download_link' => 'required']);

        /* START custom value set */
        $request->merge(array('d_links' => $request->download_link));
        if (isset($request->driver_type) && count($request->driver_type) > 0) {
            $driverArr = implode(",", $request->driver_type);
            $request->merge(array('driver_type' => $driverArr));
        } else {
            $request->merge(array('driver_type' => null));
        }
        if ($request->tutorial_id == "" || empty($request->tutorial_id)) {
            $request->merge(array('tutorial_id' => NULL));
        }
        if (isset($request->featured) && $request->featured == 1) {
            $request->merge(array('featured' => 1));
        } else {
            $request->merge(array('featured' => 0));
        }
        /* START custom value set */


        try {
            $input = $request->except(['_token', 'country']);
            $this->driverRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("driver.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('driver.list')->withMessage(Config::get('acl_messages.flash.success.driver_edit_success'));
    }

    public function delete(Request $request) {
        $this->driverRepository->delete($request->id);
        return Redirect::route('driver.list')->withMessage(Config::get('acl_messages.flash.success.driver_delete_success'));
    }

    /*CMS Page View*/

    public function getDriver(Request $request){
        $results = $this->driverRepository->allWhere($request->except(['page']), $request);
        $category = $this->viewCategoryRepository->find($request->view_category_id);
        return View::make('admin.pages.driverCategoryDriverDevice')->with(['results'=>$results, 'request'=>$request, 'category'=>$category]);
    }

}
