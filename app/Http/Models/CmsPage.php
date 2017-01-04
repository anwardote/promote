<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\LoginRequiredException;
use App\Http\Models\CmsCategory;
use Cviebrock\EloquentSluggable\Sluggable;

class CmsPage extends Model
{

    protected $table = 'cms_pages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['template', 'name', 'title', 'slug', 'banner_type', 'content', 'extras'];
    protected $fakeColumns = ['extras'];


    public function getTemplateName()
    {
        return trim(preg_replace('/(id|at|\[\])$/i', '', ucfirst(str_replace('_', ' ', $this->template))));
    }

    public function getPageLink()
    {
        return url($this->slug);
    }

    public function getPageAnchor()
    {
        return '<a href="'.$this->getPageLink().'" target="_blank">Preview</a>';
    }

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrTitleAttribute($title, $slug)
    {
        $title=strtolower($title);
        $slug=strtolower($slug);

        if ($slug != '') {
            return str_replace(' ', '_',$slug);
            //return \Str::slug($slug, '-');
        }

        return \Str::slug($title, '-');
    }

}
