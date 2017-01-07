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
use App\Repositories\RechargeRepository;
use App\Repositories\RechargeTypeRepository;

class RechargesController extends Controller
{

    protected $auth;
    protected $logged_user;
    protected $rechargeRepository;
    protected $rechargeTypeRepository;


    public function __construct(AuthenticateInterface $auth, RechargeRepository $rechargeRepo, RechargeTypeRepository $rechargeTypeRepo)
    {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->rechargeRepository = $rechargeRepo;
        $this->rechargeTypeRepository = $rechargeTypeRepo;

    }

    public function getIndex()
    {
        $info = "welcome to web page";
        return View::make('admin.home.index')->with(['user_data' => $this->logged_user, 'info' => $info]);
    }

    public function getAdminList(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $user_group = $logged_user->groups()->first()->name;
        if ($user_group === 'superadmin' || $user_group === 'admin') {
            $results = $this->rechargeRepository->all($request->except(['page']));
            return View::make('laravel-authentication-acl::admin.recharge-info.list')->with(['user_data' => $this->auth->getLoggedUser(), 'results' => $results, 'request' => $request]);
        }

        $results = $this->rechargeRepository->whereall($request->except(['page']), $logged_user->id);
        return View::make('laravel-authentication-acl::admin.recharge-info.list')->with(['user_data' => $this->auth->getLoggedUser(), 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $user_group = $logged_user->groups()->first()->name;
        if (empty($request->recharge_type)) {
            $recharge_types = $this->rechargeTypeRepository->find(5);
        } else {
            $recharge_types = $this->rechargeTypeRepository->find($request->recharge_type);
        }

        if ($user_group === 'superadmin' || $user_group === 'admin') {
            return View::make('laravel-authentication-acl::admin.recharge-info.new-admin')->with(['user_data' => $this->auth->getLoggedUser(), 'recharge_types' => $recharge_types, 'request' => $request]);
        }
        return View::make('laravel-authentication-acl::admin.recharge-info.new')->with(['user_data' => $this->auth->getLoggedUser(), 'recharge_types' => $recharge_types, 'request' => $request]);
    }

    public function postNew(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();

        $this->validate($request, ['recharge_type_id' => 'required', 'amount' => 'required|numeric', 'date' => 'required', 'ac_from' => 'required', 'ac_to' => 'required', 'trans_no' => 'required', 'status' => 'required', 'requested_for' => 'required']);

        $request->merge(array('user_id' => $logged_user->id));
        try {
            $input = $request->except(['_token']);
            $this->rechargeRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            $user_group = $logged_user->groups()->first()->name;

            if ($user_group === 'superadmin' || $user_group === 'admin') {
                return Redirect::route("recharge.new-admin", [])->withInput()->withErrors($errors);
            }
            return Redirect::route("recharge.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('recharge.list')->withMessage(Config::get('acl_messages.flash.success.firmware_new_success'));
    }

    public function getUpdate(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $user_group = $logged_user->groups()->first()->name;
        $results = $this->rechargeRepository->find($request->id);


        if ($request->recharge_type == null || empty($request->recharge_type)) {
            $recharge_types = $this->rechargeTypeRepository->find($results->recharge_type_id);
        } else {
            $recharge_types = $this->rechargeTypeRepository->find($request->recharge_type);
        }

        if ($user_group === 'superadmin' || $user_group === 'admin') {
            return View::make('laravel-authentication-acl::admin.recharge-info.edit-admin')->with(['user_data' => $this->auth->getLoggedUser(), 'data' => $results, 'recharge_types' => $recharge_types]);
        }
        if ($results->status === 'approved') {
            echo '<h1 style="color: red">You are not allow to modify approved recharge information.</h1>';
            exit;
        }
        return View::make('laravel-authentication-acl::admin.recharge-info.edit')->with(['user_data' => $this->auth->getLoggedUser(), 'data' => $results, 'recharge_types' => $recharge_types]);
    }


    public function postUpdate(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['recharge_type_id' => 'required', 'amount' => 'required|numeric', 'date' => 'required', 'ac_from' => 'required', 'ac_to' => 'required', 'trans_no' => 'required']);

        try {
            $input = $request->except(['_token']);
            $this->rechargeRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            $user_group = $logged_user->groups()->first()->name;
            if ($user_group === 'superadmin' || $user_group === 'admin') {
                return Redirect::route("recharge.edit-admin", [])->withInput()->withErrors($errors);
            }
            return Redirect::route("recharge.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('recharge.list')->withMessage(Config::get('acl_messages.flash.success.firmware_edit_success'));
    }

    public function getDetail(Request $request)
    {
        $results = $this->rechargeRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.recharge-info.detail')->with(['user_data' => $this->auth->getLoggedUser(), 'data' => $results]);
    }

    public function delete(Request $request)
    {
        $this->rechargeRepository->delete($request->id);
        return Redirect::route('recharge.list')->withMessage(Config::get('acl_messages.flash.success.firmware_delete_success'));
    }


}
