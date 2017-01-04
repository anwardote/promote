<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\Http\Models\Fcategory;

class ViewCategory extends Model
{

    protected $fillable = ['title', 'description', 'fcategory_id', 'search_engine'];

    public function fcategory()
    {
        return $this->belongsTo(Fcategory::class);
    }

}
