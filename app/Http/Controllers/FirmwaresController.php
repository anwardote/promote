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
use App\Http\Models\Firmware;
use App\Repositories\FirmwareRepository;
use App\Repositories\GlobalRepository;
use App\Repositories\ViewCategoryRepository;

class FirmwaresController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $firmwareRepository;
    protected $globalrepository;
    protected $viewCategoryRepository;

    public function __construct(AuthenticateInterface $auth, FirmwareRepository $firmwareRepo, GlobalRepository $globalRepo, ViewCategoryRepository $viewCategoryRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->firmwareRepository = $firmwareRepo;
        $this->globalrepository = $globalRepo;
        $this->viewCategoryRepository = $viewCategoryRepo;
    }

    public function getIndex() {
        $info = "welcome to web page";
        return View::make('admin.home.index')->with(['user_data' => $this->logged_user, 'info' => $info]);
    }

    public function getAdminList(Request $request) {
        $results = $this->firmwareRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.firmware.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        $category=$this->globalrepository->findcatForFirmware([1,2]);
        return View::make('laravel-authentication-acl::admin.firmware.new')->with(['user_data' => $this->logged_user, 'view_category' => $category]);
    }

    public function postNew(Request $request) {
        $logged_user = $this->auth->getLoggedUser();

        $downloadLink = implode(",", $request->download_link);
        $request->merge(array('download_link' => $downloadLink));

        $this->validate($request, ['fcategory_id' => 'required', 'view_category_id'=>'required', 'device_id' => 'required', 'device_model' => 'required', 'device_version' => 'required', 'status' => 'required', 'download_link' => 'required']);


        /* START custom value set */
        $request->merge(array('d_links' => $request->download_link));
        if (isset($request->country) && count($request->country) > 0) {
            $countryArr = implode(",", $request->country);
            $request->merge(array('country_id' => $countryArr));
        } else {
            $request->merge(array('country_id' => null));
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
            $input = $request->except(['_token', 'country']);
            $this->firmwareRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("firmware.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('firmware.list')->withMessage(Config::get('acl_messages.flash.success.firmware_new_success'));
    }

    public function getUpdate(Request $request) {
        $category=$this->globalrepository->findcatForFirmware([1,2]);
        $result = $this->firmwareRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.firmware.edit')->with(['data' => $result, 'view_category'=>$category]);
    }

    public function postUpdate(Request $request) {
        $downloadLink = implode(",", $request->download_link);
        $request->merge(array('download_link' => $downloadLink));

        $this->validate($request, ['fcategory_id' => 'required', 'view_category_id'=>'required', 'device_id' => 'required', 'device_model' => 'required', 'device_version' => 'required', 'status' => 'required', 'download_link' => 'required']);


        /* START custom value set */
        $request->merge(array('d_links' => $request->download_link));
        if (isset($request->country) && count($request->country) > 0) {
            $countryArr = implode(",", $request->country);
            $request->merge(array('country_id' => $countryArr));
        } else {
            $request->merge(array('country_id' => null));
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
            $this->firmwareRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("firmware.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('firmware.list')->withMessage(Config::get('acl_messages.flash.success.firmware_edit_success'));
    }

    public function delete(Request $request) {
        $this->firmwareRepository->delete($request->id);
        return Redirect::route('firmware.list')->withMessage(Config::get('acl_messages.flash.success.firmware_delete_success'));
    }

    /*CMS Page View*/

    public function getFirmware(Request $request){
        $results = $this->firmwareRepository->allWhere($request->except(['page']), $request);
        $category = $this->viewCategoryRepository->find($request->view_category_id);
        return View::make('admin.pages.firmwareCategoryFirmwarDevice')->with(['results'=>$results, 'request'=>$request, 'category'=>$category]);
    }

}
