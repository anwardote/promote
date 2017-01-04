<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\User;

class Tutorial extends Model {

    protected $fillable = ['st_instruct', 'requirements', 'title', 'description', 'noted', 'user_id'];

    public function firmware() {
        return $this->hasMany(Template::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

}
