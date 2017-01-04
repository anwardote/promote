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
use App\Http\Models\DriverType;
use App\Repositories\DriverTypeRepository;

class DriverTypesController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $driverTypeRepository;

    public function __construct(AuthenticateInterface $auth, DriverTypeRepository $driverTypeRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->driverTypeRepository = $driverTypeRepo;
    }

    public function getList(Request $request) {
        $results = $this->driverTypeRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.driver-type.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        return View::make('laravel-authentication-acl::admin.driver-type.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request) {

        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['name' => 'required']);
        try {
            $input = $request->except(['_token']);
            $this->driverTypeRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("driver-type.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('driver-type.list')->withMessage(Config::get('acl_messages.flash.success.driver-type_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->driverTypeRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.driver-type.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request) {

       $this->validate($request, ['name' => 'required']);

        try {
            $input = $request->except(['_token']);
            $this->driverTypeRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("driver-type.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('driver-type.list')->withMessage(Config::get('acl_messages.flash.success.driver-type_edit_success'));
    }

    public function delete(Request $request) {
        $this->driverTypeRepository->delete($request->id);
        return Redirect::route('driver-type.list')->withMessage(Config::get('acl_messages.flash.success.driver-type_delete_success'));
    }

}
