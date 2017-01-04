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
use App\Http\Models\Tutorial;
use App\Repositories\TutorialRepository;

class TutorialsController extends Controller {

    protected $auth;
    protected $logged_user;
    protected $tutorialRepository;

    public function __construct(AuthenticateInterface $auth, TutorialRepository $tutorialRepo) {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->tutorialRepository = $tutorialRepo;
    }

    public function getIndex() {
        $info = "welcome to web page";
        return View::make('admin.home.index')->with(['user_data' => $this->logged_user, 'info' => $info]);
    }

    public function getAdminList(Request $request) {
        $results = $this->tutorialRepository->all($request->except(['page']));
        return View::make('laravel-authentication-acl::admin.tutorial.list')->with(['user_data' => $this->logged_user, 'results' => $results, 'request' => $request]);
    }

    public function getNew(Request $request) {
        return View::make('laravel-authentication-acl::admin.tutorial.new')->with(['user_data' => $this->logged_user]);
    }

    public function postNew(Request $request) {
        $logged_user = $this->auth->getLoggedUser();
        $this->validate($request, ['title' => 'required', 'description' => 'required']);
        $request->merge(array('user_id' => $logged_user->id));
        try {
            $input = $request->except(['_token']);
            $this->tutorialRepository->create($input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("tutorial.new", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('tutorial.list')->withMessage(Config::get('acl_messages.flash.success.tutorial_new_success'));
    }

    public function getUpdate(Request $request) {
        $result = $this->tutorialRepository->find($request->id);
        return View::make('laravel-authentication-acl::admin.tutorial.edit')->with(['data' => $result]);
    }

    public function postUpdate(Request $request) {

        $this->validate($request, ['title' => 'required', 'description' => 'required']);

        try {
            $input = $request->except(['_token']);
            $this->tutorialRepository->update($input['id'], $input);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("tutorial.edit", [])->withInput()->withErrors($errors);
        }
        return Redirect::route('tutorial.list')->withMessage(Config::get('acl_messages.flash.success.tutorial_edit_success'));
    }

    public function delete(Request $request) {
        $this->tutorialRepository->delete($request->id);
        return Redirect::route('tutorial.list')->withMessage(Config::get('acl_messages.flash.success.tutorial_delete_success'));
    }


    public function getTutorial(Request $request){
        $result = $this->tutorialRepository->find($request->id);
        $result= (Object) $result->toArray();
        return View::make('admin.pages.tutorialById')->with(['result'=>$result, 'request'=>$request]);
    }

}
