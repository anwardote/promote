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
use App\Http\Models\Variable;
use App\Repositories\VariableRepository;

class VariablesController extends Controller
{

    protected $auth;
    protected $logged_user;
    protected $variableRepository;

    public function __construct(AuthenticateInterface $auth, VariableRepository $varRepository)
    {
        $this->auth = $auth;
        $this->logged_user = $this->auth->getLoggedUser();
        $this->variableRepository = $varRepository;
    }

    public function getUpdate(Request $request)
    {
        $result = $this->variableRepository->find(1);
        $variables= json_decode($result['variables'], true);
        $result = (Object)array_merge($result['original'], $variables);
        return View::make('laravel-authentication-acl::admin.variable.edit')->with(['data' => $result, 'user' => $this->logged_user]);
    }

    public function postUpdate(Request $request)
    {
        $variable = json_encode($request->except(['_token', 'id']));
        $varArr['variables']=$variable;
        try {
            $this->variableRepository->update($request->id, $varArr);
        } catch (JacopoExceptionsInterface $e) {
            $errors = $this->f->getErrors();
            return Redirect::route("variable.edit", [])->withInput()->withErrors($errors);
        }
            return Redirect::route('variable.edit')->withMessage(Config::get('acl_messages.flash.success.cms_post_edit_success'));
    }

    public function delete(Request $request)
    {
        $this->cmsPostRepository->delete($request->id);
        return Redirect::route('post.list')->withMessage(Config::get('acl_messages.flash.success.cms_post_delete_success'));
    }

}
