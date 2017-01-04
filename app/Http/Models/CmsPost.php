<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\Http\Models\CmsCategory;

class CmsPost extends Model {

    protected $fillable = ['cms_category_id', 'title', 'slug', 'content', 'image', 'status', 'date', 'featured', 'source'];

    public function cmscategory() {
        return $this->belongsTo(CmsCategory::class, 'cms_category_id');
    }

}
