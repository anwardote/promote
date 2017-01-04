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
use App\Http\Models\Tool;
use App\Repositories\ToolRepository;
use App\Repositories\GlobalRepository;

class ToolsController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $toolRepository;
    protected $globalrepository;

    public function __construct(AuthenticateInterface $auth, ToolRepository $toolRepo, GlobalRepository $globalRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->toolRepository = $toolRepo;
        $this->globalrepository = $globalRepo;
    }

    public function getIndex() {
        $info = "welcome to web page";
        return View::make('admin.tool.index')->with(['user_data' => $this->logged_user, 'info' => $info]);
    }

    public function getAdminList(Request $request) {
        $results = $this->toolRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.tool.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        $category=$this->globalrepository->findcatForFirmware([4,4]);
        return View::make('laravel-authentication-acl::admin.tool.new')->with(['user_data' => $this->logged_user, 'view_category'=>$category]);
    }

    public function postNew(Request $request) {
        $logged_user = $this->auth->getLoggedUser();

        $downloadLink = implode(",", $request->download_link);
        $request->merge(array('download_link' => $downloadLink));

        $this->validate($request, [ 'title' => 'required', 'instructions' => 'required', 'supports' => 'required', 'status' => 'required', 'download_link' => 'required']);

        /* START custom value set */
        $request->merge(array('d_links' => $request->download_link));
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
            $this->toolRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("tool.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('tool.list')->withMessage(Config::get('acl_messages.flash.success.tool_new_success'));
    }

    public function getUpdate(Request $request) {
        $category=$this->globalrepository->findcatForFirmware([4,4]);
        $result = $this->toolRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.tool.edit')->with(['data' => $result, 'view_category'=>$category]);
    }

    public function postUpdate(Request $request) {
        $downloadLink = implode(",", $request->download_link);
        $request->merge(array('download_link' => $downloadLink));

        $this->validate($request, [ 'title' => 'required', 'instructions' => 'required', 'supports' => 'required', 'status' => 'required', 'download_link' => 'required']);

        /* START custom value set */
        $request->merge(array('d_links' => $request->download_link));
            if (isset($request->featured) && $request->featured == 1) {
            $request->merge(array('featured' => 1));
        } else {
            $request->merge(array('featured' => 0));
        }
        /* START custom value set */


        try {
            $input = $request->except(['_token', 'country']);
            $this->toolRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("tool.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('tool.list')->withMessage(Config::get('acl_messages.flash.success.tool_edit_success'));
    }

    public function delete(Request $request) {
        $this->toolRepository->delete($request->id);
        return Redirect::route('tool.list')->withMessage(Config::get('acl_messages.flash.success.tool_delete_success'));
    }

    public function getTool(Request $request){
        $result = $this->toolRepository->find($request->id);
        $result= (Object) $result->toArray();
        return View::make('admin.pages.toolById')->with(['result'=>$result, 'request'=>$request]);
    }
}
