<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;

class RechargeType extends Model {

    protected $table = 'recharge_types';
    protected $fillable = ['type_name', 'thumbnail'];

    public function driver() {
        return $this->hasMany(Driver::class);
    }

}
