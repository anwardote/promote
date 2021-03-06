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
use App\Repositories\RechargeTypeRepository;

class RechargeTypeController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $RechargeType;

    public function __construct(AuthenticateInterface $auth, RechargeTypeRepository $rechargeTypeRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->RechargeType = $rechargeTypeRepo;
    }

    public function getList(Request $request) {
        $results = $this->RechargeType->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.recharge-type.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        return View::make('laravel-authentication-acl::admin.recharge-type.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request) {

        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['type_name' => 'required', 'ac_no' => 'required', 'image' => 'required']);
        try {
            $input = $request->except(['_token']);
            $this->RechargeType->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("recharge-type.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('recharge-type.list')->withMessage(Config::get('acl_messages.flash.success.driver-name_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->RechargeType->find($request->id);
        return View::make('laravel-authentication-acl::admin.recharge-type.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request) {

     $this->validate($request, ['type_name' => 'required', 'ac_no'=>'required', 'image' => 'required']);
        try {
            $input = $request->except(['_token']);
            $this->RechargeType->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("recharge-type.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('recharge-type.list')->withMessage(Config::get('acl_messages.flash.success.driver-name_edit_success'));
    }

    public function delete(Request $request) {
        $this->RechargeType->delete($request->id);
        return Redirect::route('rechagre-type.list')->withMessage(Config::get('acl_messages.flash.success.driver-name_delete_success'));
    }

}
