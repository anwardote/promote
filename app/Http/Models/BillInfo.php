<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\Http\Models\RechargeType;
use App\User;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserProfilePresenter;

class BillInfo extends Model
{

    protected $table = 'bill_infos';
    protected $fillable = ['date', 'subject', 'description', 'amount', 'created_by', 'created_for','status'];

    public function user_created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


    public function user_created_for()
    {
        return $this->belongsTo(User::class, 'created_for');
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
