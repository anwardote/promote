<?php

namespace App;

class PageTemplates
{

    public function __construct()
    {
        $fields = Array();
    }

    public function getArray($method)
    {
        return $this->$method();
    }

    /*Home Page Start*/
    public function home()
    {
//        $fields['url'] =
//            [
//                'type' => 'input',
//                'name' => 'url',
//                'label' => 'URL',
//                'class' => '',
//                'placeholder' => 'Your url here',
//                'hint' => 'test hints 1',
//                'parent_class' => 'form-group',
//            ];

        $fields['source'] =
            [
                'type' => 'input',
                'name' => 'source',
                'label' => 'Source',
                'class' => 'tinymce',
                'placeholder' => 'Your source here',
                'parent_class' => 'form-group',
            ];

        return $fields;
    }

    /*Home Page End*/

    public function tutorial()
    {

    }

    public function firmware()
    {

    }

    public function driver()
    {
    }

    public function tool()
    {
    }


}
