<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;

class DriverName extends Model {

    protected $fillable = ['name', 'image', 'introductions'];

    public function driver() {
        return $this->hasMany(Driver::class);
    }

}
