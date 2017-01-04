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
use App\Http\Models\DriverName;
use App\Repositories\DriverNameRepository;

class DriverNamesController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $driverNameRepository;

    public function __construct(AuthenticateInterface $auth, DriverNameRepository $driverNameRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->driverNameRepository = $driverNameRepo;
    }

    public function getList(Request $request) {
        $results = $this->driverNameRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.driver-name.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        return View::make('laravel-authentication-acl::admin.driver-name.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request) {

        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['name' => 'required', 'image' => 'required']);
        try {
            $input = $request->except(['_token']);
            $this->driverNameRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("driver-name.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('driver-name.list')->withMessage(Config::get('acl_messages.flash.success.driver-name_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->driverNameRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.driver-name.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request) {

       $this->validate($request, ['name' => 'required', 'image' => 'required']);

        try {
            $input = $request->except(['_token']);
            $this->driverNameRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("driver-name.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('driver-name.list')->withMessage(Config::get('acl_messages.flash.success.driver-name_edit_success'));
    }

    public function delete(Request $request) {
        $this->driverNameRepository->delete($request->id);
        return Redirect::route('driver-name.list')->withMessage(Config::get('acl_messages.flash.success.driver-name_delete_success'));
    }

}
