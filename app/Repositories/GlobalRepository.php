<?php

namespace App\Repositories;


use App\Http\Models\ViewCategory;
use Config,
    Event;

class GlobalRepository
{


    public function __construct()
    {

    }


    public function findSelect($category_id)

    {
        try {
            $Model = new ViewCategory();
            $data = $Model->where('fcategory_id', $category_id)->get();
        } catch (GroupNotFoundException $e) {
            throw new NotFoundException;
        }

        return $data;
    }


    public function findcatForFirmware($category_id)

    {
        try {
            $Model = new ViewCategory();
            $data = $Model->select('id', 'title')->whereBetween('fcategory_id', $category_id)->get();
            $data=$data->toArray();
        } catch (GroupNotFoundException $e) {
            throw new NotFoundException;
        }

        $data=array_column($data, 'title', 'id');
        $data=array('' => 'Select One') + $data;
        return $data;
    }


}
