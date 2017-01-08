<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;

class Variable extends Model
{

    protected $fillable = ['variables'];
}
