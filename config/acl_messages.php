<?php

return [
        "email" => [
            /*
            |--------------------------------------------------------------------------
            | Email subject
            |--------------------------------------------------------------------------
            |
            | Here you can change the subject of each email sent in the system
            |
            */

            /*
             * User registration request
             */
            "user_registration_request_subject"     => "Registration request to: Authenticator",
            /*
             * User activation
             */
            "user_registraction_activation_subject" => "Your user is activated on: Authenticator",
            /*
             * User password recovery
             */
            "user_password_recovery_subject"        => "Password recovery request",
        ],

        /*
        |--------------------------------------------------------------------------
        | Flash messages
        |--------------------------------------------------------------------------
        |
        */
        "flash" => [
            /*
             * User success messages
             */
            "success" => [
                // user
                "user_edit_success"                    => "User edited with success.",
                "user_delete_success"                  => "User deleted with success.",
                "user_group_add_success"               => "Group added with success.",
                "user_group_delete_success"            => "Group deleted with success.",
                "user_permission_add_success"          => "Permission added with success.",
                "user_profile_edit_success"            => "Profile edited with success.",
                "custom_field_added"                   => "Field added succesfully.",
                "custom_field_removed"                 => "Field removed succesfully.",
                "avatar_edit_success"                  => "Avatar changed succesfully",
                // group
                "group_edit_success"                   => "Group edited succesfully.",
                "group_delete_success"                 => "Group deleted succesfully.",
                "group_permission_edit_success"        => "Permission edited succesfully.",
                // permission
                "permission_permission_edit_success"   => "Permission edited with success.",
                "permission_permission_delete_success" => "Permission deleted with success.",
                // firmware    
                "firmware_new_success"                  => "New firmware added with success.",
                "firmware_edit_success"                 => "Firmware edited with success.",
                "firmware_delete_success"               => "Firmware deleted with success.",
                // driver    
                "driver_new_success"                  => "New driver added with success.",
                "driver_edit_success"                 => "Driver edited with success.",
                "driver_delete_success"               => "Driver deleted with success.",
                 // driver
                "tool_new_success"                    => "New tool added with success.",
                "tool_edit_success"                   => "Tool type edited with success.",
                "tool_delete_success"                 => "Tool deleted with success.",  
                
                // tutorial    
                "tutorial_new_success"                  => "New Tutorial added with success.",
                "tutorial_edit_success"                 => "Tutorial edited with success.",
                "tutorial_delete_success"               => "Tutorial deleted with success.",

                // viewcategory
                "viewcategory_new_success"                  => "New View Category added with success.",
                "viewcategory_edit_success"                 => "View Category edited with success.",
                "viewcategory_delete_success"               => "View Category deleted with success.",


                // device
                "device_new_success"                    => "New device added with success.",
                "device_edit_success"                   => "Device edited with success.",
                "device_delete_success"                 => "Device deleted with success.",
                
                 // driver name
                "driver-name_new_success"                    => "New Driver name added with success.",
                "driver-name_edit_success"                   => "Driver name edited with success.",
                "driver-name_delete_success"                 => "Driver name deleted with success.",
                                 
                // driver type
                "driver-type_new_success"                    => "New Driver type added with success.",
                "driver-type_edit_success"                   => "Driver type edited with success.",
                "driver-type_delete_success"                 => "Driver type deleted with success.", 
                
                // CMS Page
                "cms_page_new_success"                    => "New CMS Page added with success.",
                "cms_page_edit_success"                   => "CMS Page edited with success.",
                "cms_page_delete_success"                 => "CMS Page deleted with success.", 
                
                // CMS Post
                "cms_post_new_success"                    => "New CMS Post added with success.",
                "cms_post_edit_success"                   => "CMS Post edited with success.",
                "cms_post_delete_success"                 => "CMS Post deleted with success.", 
                
                
            ],
            /*
             * User error messages
             */
            "error"   => [
                // user
                "user_group_not_found"       => "Group not found.",
                "user_permission_not_found"  => "Permission not found",
                "user_user_not_found"        => "User not found.",
                "custom_field_not_found"     => "Cannot find the custom field.",
                "cannot_upload_file"         => "Cannot upload the file.",
                // group
                "group_permission_not_found" => "Permission not found.",
                // permission
                // reminder
                "reset_password_error" => 'There was a problem changing the password.',
                "captcha_error" => 'Confirmation code is not valid.'
            ]
        ],
        /*
        |--------------------------------------------------------------------------
        | Various link
        |--------------------------------------------------------------------------
        |
        */
        "links" => [
                "change_password" => "Click here to change your password."
        ]
];