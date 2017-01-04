<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\Http\Models\RechargeType;
use App\User;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserProfilePresenter;

class Recharge extends Model
{

    //protected $fillable = ['fcategory_id', 'st_instruct', 'device_id', 'device_model', 'device_version', 'tutorial_id', 'country_id', 'd_links', 'd_sizes', 'noted', 'status', 'featured', 'user_id'];
    protected $table = 'recharge_infos';
    protected $fillable = ['recharge_type_id', 'amount', 'date', 'ac_from', 'ac_to', 'trans_no', 'admin_reply', 'remark', 'status', 'user_id', 'requested_for'];

    public function rechargeType()
    {
        return $this->belongsTo(RechargeType::class, 'recharge_type_id');
    }


    public function user_requested_for()
    {
        return $this->belongsTo(User::class, 'requested_for');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function user_profile()
    {
        return new UserProfile();
    }

    public function presenter()
    {
        return new UserProfilePresenter($this);
    }

}
