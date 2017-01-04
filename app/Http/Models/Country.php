<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;

class Country extends Model {

    protected $fillable = ['country_code', 'country_name'];
    public $timestamps = false;

    public function firmware() {
        return $this->hasMany(Template::class);
    }

}
