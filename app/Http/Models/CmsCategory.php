<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;

class CmsCategory extends Model {

    protected $fillable = ['parent_id', 'lft', 'rgt', 'depth', 'name'];

}
