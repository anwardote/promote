<?php
namespace App\Repositories;
/**
 * User: anwar
 * Date: 11/29/2016
 * Time: 2:06 AM
 */

class Slug
{
    private function getNewSlug($title, $slug)
    {
        $page = new CmsPage();
        $slug = $page->getSlugOrTitleAttribute($title, $slug);
        $slugInfo = $page->where('slug', $slug)->get();
        $i = count($slugInfo);
        if ($i === 0) {
            return $slug;
        }
        $i = 1;
        for ($i; $i <= 10000000; $i++) {
            $finalSlug = $slug . '-' . $i;
            $j = count($page->where('slug', $finalSlug)->get());
            if ($j == 0) {
                $i = 10000000;;
            }
        }
        return $finalSlug;
    }

    private function getUpdateSlug($title, $slug, $id)
    {
        $page = new CmsPage();
        $slug = $page->getSlugOrTitleAttribute($title, $slug);
        $slugInfo = $page->where([['slug', $slug], ['id', '<>', $id]])->get();
        $i = count($slugInfo);
        if ($i === 0) {
            return $slug;
        }
        $i = 1;
        for ($i; $i <= 10000000; $i++) {
            $finalSlug = $slug . '-' . $i;
            $j = count($page->where([['slug', $finalSlug], ['id', '<>', $id]])->get());
            if ($j == 0) {
                $i = 10000000;
            }
        }
        return $finalSlug;
    }


    // The slug is created automatically from the "name" fied if no slug exists.
    public function getSlugOrTitleAttribute($title, $slug)
    {
        $title = strtolower($title);
        $slug = strtolower($slug);

        if ($slug != '') {
            return str_replace(' ', '_', $slug);
        }

        return \Str::slug($title, '-');
    }
}