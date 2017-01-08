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
use App\Repositories\BillInfoRepository;

class BillInfosController extends Controller
{

    protected $auth;
    protected $logged_user;
    protected $billRepository;


    public function __construct(AuthenticateInterface $auth, BillInfoRepository $billInfoRepo)
    {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->billRepository = $billInfoRepo;
    }

    public function getList(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $results = $this->billRepository->wherealluser($request->except(['page']), $logged_user->id);
        return View::make('laravel-authentication-acl::admin.recharge-info.bill-list')->with(['user_data' => $this->auth->getLoggedUser(), 'results' => $results, 'request' => $request]);
    }

    public function getAdminList(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $user_group = $logged_user->groups()->first()->name;
        if ($user_group === 'superadmin' || $user_group === 'admin') {
            $results = $this->billRepository->all($request->except(['page']));
            return View::make('laravel-authentication-acl::admin.bill-info.list')->with(['user_data' => $this->auth->getLoggedUser(), 'results' => $results, 'request' => $request]);
        }

        $results = $this->billRepository->whereall($request->except(['page']), $logged_user->id);
        return View::make('laravel-authentication-acl::admin.bill-info.list')->with(['user_data' => $this->auth->getLoggedUser(), 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request)
    {
        return View::make('laravel-authentication-acl::admin.bill-info.new-admin')->with(['user_data' => $this->auth->getLoggedUser(), 'request' => $request]);
    }

    public function postNew(Request $request)
    {
        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['subject' => 'required', 'description' => 'required', 'date' => 'required', 'status' => 'required', 'created_for' => 'required']);
        $request->merge(array('created_by' => $logged_user->id));
        try {
            $input = $request->except(['_token']);
            $this->billRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("bill.new-admin", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('bill.list')->withMessage(Config::get('acl_messages.flash.success.firmware_new_success'));
    }

    public function getUpdate(Request $request)
    {
        $results = $this->billRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.bill-info.edit-admin')->with(['user_data' => $this->auth->getLoggedUser(), 'data' => $results]);
    }


    public function postUpdate(Request $request)
    {
        $this->validate($request, ['subject' => 'required', 'description' => 'required', 'date' => 'required', 'status' => 'required', 'created_for' => 'required']);

        try {
            $input = $request->except(['_token']);
            $this->billRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("bill.edit-admin", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('bill.list')->withMessage(Config::get('acl_messages.flash.success.firmware_edit_success'));
    }

    public function getDetail(Request $request)
    {
        $results = $this->billRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.bill-info.detail')->with(['user_data' => $this->auth->getLoggedUser(), 'data' => $results]);
    }

    public function getBilldetail(Request $request)
    {
        $results = $this->billRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.recharge-info.bill-detail')->with(['user_data' => $this->auth->getLoggedUser(), 'data' => $results]);
    }

    public function delete(Request $request)
    {
        $this->billRepository->delete($request->id);
        return Redirect::route('bill.list')->withMessage(Config::get('acl_messages.flash.success.firmware_delete_success'));
    }


}
