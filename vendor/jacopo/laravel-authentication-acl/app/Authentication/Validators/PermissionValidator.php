<?php namespace LaravelAcl\Authentication\Validators;

use Event;
use LaravelAcl\Library\Validators\AbstractValidator;

class PermissionValidator extends AbstractValidator
{
    protected static $rules = array(
        "description" => ["required", "max:255"],
        "permission" => ["required", "max:255"],
    );

    public function __construct()
    {
        Event::listen('validating', function($input)
        {
            if(isset($input['id']) && !empty($input['id'])){
                static::$rules["permission"][] = "unique:permission,permission,{$input['id']}";
            } else {
                static::$rules["permission"][] = "unique:permission,permission";
            }

        });
    }
} 