<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\User;

class Tool extends Model {

    //protected $fillable = ['fcategory_id', 'st_instruct', 'device_id', 'device_model', 'device_version', 'tutorial_id', 'country_id', 'd_links', 'd_sizes', 'noted', 'status', 'featured', 'user_id'];
    protected $fillable = ['user_id', 'title', 'supports', 'instructions', 'd_links', 'd_sizes', 'noted', 'status', 'featured'];

     public function user() {
        return $this->belongsTo(User::class);
    }

}
