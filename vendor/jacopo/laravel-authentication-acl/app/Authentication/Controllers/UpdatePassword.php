<?php

namespace LaravelAcl\Authentication\Controllers;

/**
 * Class UserController
 *
 * @author jacopo beschi jacopo@jacopobeschi.com
 */
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use LaravelAcl\Authentication\Exceptions\PermissionException;
use LaravelAcl\Authentication\Exceptions\ProfileNotFoundException;
use LaravelAcl\Authentication\Helpers\DbHelper;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Models\UserUpload;
use LaravelAcl\Authentication\Presenters\UserPresenter;
use LaravelAcl\Authentication\Services\UserProfileService;
use LaravelAcl\Authentication\Validators\UserProfileAvatarValidator;
use LaravelAcl\Library\Exceptions\NotFoundException;
use LaravelAcl\Authentication\Models\User;
use LaravelAcl\Authentication\Models\Group;
use LaravelAcl\Authentication\Helpers\FormHelper;
use LaravelAcl\Authentication\Exceptions\UserNotFoundException;
use LaravelAcl\Authentication\Validators\UserValidator;
use LaravelAcl\Library\Exceptions\JacopoExceptionsInterface;
use LaravelAcl\Authentication\Validators\UserProfileValidator;
use View,
    Redirect,
    App,
    DB,
    Config,
    Response,
    Mail,
    Hash;
use LaravelAcl\Authentication\Interfaces\AuthenticateInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\LogActivityRepository;
use LaravelAcl\Authentication\Repository\UserUploadRepository;
use LaravelAcl\Authentication\Controllers\UserController as UserController;
use LaravelAcl\Authentication\Services\ReminderService;

class UpdatePassword extends Controller {

    /**
     * @var \LaravelAcl\Authentication\Repository\SentryUserRepository
     */
    protected $user_repository;
    protected $user_validator;
    protected $profile_repository;

    /**
     * @var \LaravelAcl\Authentication\Helpers\FormHelper
     */
    protected $form_helper;
    protected $userController;
    protected $reminder;

    public function __construct(UserValidator $v, FormHelper $fh, UserController $UserController, ReminderService $reminder) {
        $this->user_repository = App::make('user_repository');
        $this->user_validator = $v;
        $this->form_helper = $fh;
        $this->userController = $UserController;
        $this->f = App::make('form_model', [$this->user_validator, $this->user_repository]);
        $this->reminder = $reminder;
    }

    public function getPasswordUpdate(Request $request) {
        $nowTime = time();
        $created_time = $request['expire'];
        $expire_time = strtotime('+1 day', $created_time);
        $expireResult = $expire_time - $created_time;
        if ($expireResult > $nowTime) {
            return "Your token has already been expired!. Please visit the site using <a href='/' target='_blank'>following link</a>.";
        }
        $user = new User();
        $userInfo = $user->where('user_token', $request['_token'])->get();
        if (count($userInfo) === 1) {
            return View::make('laravel-authentication-acl::admin.user.update-password')
                            ->with(['persist_code' => $request['_token'], 'user' => $userInfo['0']]);
        } else {
            return "Your token is not valid.";
        }
    }

    public function postPasswordUpdate(Request $request) {
        $error = Array();
        if ($request['password'] != $request['re-password']) {
            $errar['error'] = "Password does not match.";
            return redirect()->route("users.password-update")->with(['errors' => $errar]);
        }

        if ($request['password'] == '') {
            $errar['error'] = "Cannot be empty.";
            return redirect()->route("users.password-update")->with(['errors' => $errar]);
        }


        $user = new User();
        $userInfo = $user->where('user_token', $request['user_token'])->get();
        if (count($userInfo) != 1) {
            $errar['error'] = "Your token is not valid.";
            return redirect()->route("users.password-update")->with(['errors' => $errar]);
        }


        if ($request['password'] == '') {
            $errar['error'] = "Cannot be empty.";
            return redirect()->route("users.password-update")->with(['errors' => $errar]);
        }


        try {
            $userModel = User::find($request['id']);
            $userModel->user_token = null;
            $userModel->update();

            $email = $request['email'];
            $token = $request['token'];
            $password = $request['password'];
            $this->reminder->reset($email, $token, $password);
            return redirect()->route("user.admin.login");
        } catch (JacopoExceptionsInterface $e) {
            return redirect()->route("users.password-update")->with(['errors' => 'Something wrong.']);
        }
    }

}
