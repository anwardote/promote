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
use App\Http\Models\BillInfo;
use App\Http\Models\Recharge;

class GlobalController extends Controller
{

    protected $auth;


    public function __construct(AuthenticateInterface $auth)
    {
        $this->auth = $auth;

    }

    public function getSummary(Request $request)
    {
        $loginUser = $this->auth->getLoggedUser();
        $user_group = $loginUser->groups()->first()->name;
        $summaryArr = [];

        $RechargeAmount = new Recharge();
        $BillingAmount = new BillInfo();
        if ($user_group === 'superadmin' || $user_group === 'admin') {
            $RechargeAmount = $RechargeAmount->where([['status', 'approved']])->sum('amount');
            $BillingAmount = $BillingAmount->where([['status', 'PUBLISHED']])->sum('amount');
        } elseif(isset($request->user_id)){
            $RechargeAmount = $RechargeAmount->where([['requested_for', $request->user_id], ['status', 'approved']])->sum('amount');
            $BillingAmount = $BillingAmount->where([['created_for', $request->user_id], ['status', 'PUBLISHED']])->sum('amount');
            dd($request->user_id);
        } else {
            $RechargeAmount = $RechargeAmount->where([['requested_for', $loginUser->id], ['status', 'approved']])->sum('amount');
            $BillingAmount = $BillingAmount->where([['created_for', $loginUser->id], ['status', 'PUBLISHED']])->sum('amount');
        }


        $summaryArr['recharge_amount'] = number_format($RechargeAmount, 2, '.', ',');
        $summaryArr['bill_amount'] = number_format($BillingAmount, 2, '.', ',');
        $summaryArr['balance_amount'] = number_format($RechargeAmount - $BillingAmount, 2, '.', ',');

        return $summaryArr;

    }

    public function getBalance(Request $request)
    {
        $loginUser = $this->auth->getLoggedUser();
        $user_group = $loginUser->groups()->first()->name;
        $summaryArr = [];

        $RechargeAmount = new Recharge();
        $BillingAmount = new BillInfo();
     if(isset($request->user_id)){
            $RechargeAmount = $RechargeAmount->where([['requested_for', $request->user_id], ['status', 'approved']])->sum('amount');
            $BillingAmount = $BillingAmount->where([['created_for', $request->user_id], ['status', 'PUBLISHED']])->sum('amount');

        }


        $summaryArr['recharge_amount'] = number_format($RechargeAmount, 2, '.', ',');
        $summaryArr['bill_amount'] = number_format($BillingAmount, 2, '.', ',');
        $summaryArr['balance_amount'] = number_format($RechargeAmount - $BillingAmount, 2, '.', ',');

        return $summaryArr;

    }


}
