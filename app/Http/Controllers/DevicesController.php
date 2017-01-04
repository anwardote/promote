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
use App\Http\Models\Device;
use App\Repositories\DeviceRepository;

class DevicesController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $tutorialRepository;

    public function __construct(AuthenticateInterface $auth, DeviceRepository $deviceRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->deviceRepository = $deviceRepo;
    }

    public function getList(Request $request) {
        $results = $this->deviceRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.device.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        return View::make('laravel-authentication-acl::admin.device.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request) {
        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['name' => 'required', 'image' => 'required']);
       // $request->merge(array('user_id' => $logged_user->id));
        try {
            $input = $request->except(['_token']);
            $this->deviceRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("device.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('device.list')->withMessage(Config::get('acl_messages.flash.success.device_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->deviceRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.device.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request) {

       $this->validate($request, ['name' => 'required', 'image' => 'required']);

        try {
            $input = $request->except(['_token']);
            $this->deviceRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("device.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('device.list')->withMessage(Config::get('acl_messages.flash.success.device_edit_success'));
    }

    public function delete(Request $request) {
        $this->deviceRepository->delete($request->id);
        return Redirect::route('device.list')->withMessage(Config::get('acl_messages.flash.success.device_delete_success'));
    }

}
