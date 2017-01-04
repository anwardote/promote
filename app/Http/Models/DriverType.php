<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;

class DriverType extends Model {

    protected $fillable = ['name'];
    
//    public function driverType() {
//        return $this->hasMany(Driver::class('driver_type'));
//    }

}
