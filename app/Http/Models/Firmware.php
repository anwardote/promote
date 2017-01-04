<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\Http\Models\Fcategory;
use App\Http\Models\Device;
use App\Http\Models\Tutorial;
use App\Http\Models\Country;
use App\Http\Models\ViewCategory;
use App\User;
use LaravelAcl\Authentication\Models\UserProfile;
use LaravelAcl\Authentication\Presenters\UserProfilePresenter;

class Firmware extends Model
{

    //protected $fillable = ['fcategory_id', 'st_instruct', 'device_id', 'device_model', 'device_version', 'tutorial_id', 'country_id', 'd_links', 'd_sizes', 'noted', 'status', 'featured', 'user_id'];
    protected $fillable = ['fcategory_id', 'device_id', 'tutorial_id', 'country_id', 'user_id', 'view_category_id', 'st_instruct', 'device_model', 'device_version', 'd_links', 'd_sizes', 'noted', 'status', 'featured'];

    public function fcategory()
    {
        return $this->belongsTo(Fcategory::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
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

    public function viewcatgory()
    {
        return $this->belongsTo(ViewCategory::class);
    }

    public function getcountryName($countryArr)
    {
        $countryArr = explode(',', $countryArr);
        $model = new Country();
        $countryName = $model->select('country_name')
            ->whereIn('id', $countryArr)// pass an array
            ->orderBy('id', 'ASC')
            ->get();

        return $countryName->toArray();
    }

}
