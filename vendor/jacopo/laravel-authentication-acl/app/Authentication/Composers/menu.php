<?php

use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

/**
 * menu items available depending on permissions
 */
View::composer('laravel-authentication-acl::admin.layouts.*', function ($view) {
    $menu_items = SentryMenuFactory::create()->getItemListAvailable();
    $view->with('menu_items', $menu_items);
});

/**
 * Dashboard sidebar
 */
View::composer(['laravel-authentication-acl::admin.dashboard.*'], function ($view) {
    $view->with('sidebar_items', [
        "Dashboard" => [
            "url" => URL::route('dashboard.default'),
            "icon" => '<i class="fa fa-tachometer"></i>'
        ]
    ]);
});

/**
 * User sidebar
 */
View::composer([
    'laravel-authentication-acl::admin.user.edit',
    'laravel-authentication-acl::admin.user.groups',
    'laravel-authentication-acl::admin.user.list',
    'laravel-authentication-acl::admin.user.profile',
        ], function ($view) {
    $view->with('sidebar_items', [
        "Users list" => [
            "url" => URL::route('users.list'),
            "icon" => '<i class="fa fa-user"></i>'
        ],
        "Add user" => [
            'url' => URL::route('users.edit'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});
/**
 *  Group sidebar
 */
View::composer(['laravel-authentication-acl::admin.group.*'], function ($view) {
    $view->with('sidebar_items', [
        "Groups list" => [
            'url' => URL::route('groups.list'),
            "icon" => '<i class="fa fa-users"></i>'
        ],
        "Add group" => [
            'url' => URL::route('groups.edit'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],
        "Permissions list" => [
            'url' => URL::route('permission.list'),
            "icon" => '<i class="fa fa-lock"></i>'
        ],
        "Add permission" => [
            'url' => URL::route('permission.edit'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});
/**
 *  Permission sidebar
 */
View::composer(['laravel-authentication-acl::admin.permission.*'], function ($view) {
    $view->with('sidebar_items', [
        "Groups list" => [
            'url' => URL::route('groups.list'),
            "icon" => '<i class="fa fa-users"></i>'
        ],
        "Add group" => [
            'url' => URL::route('groups.edit'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],
        "Permissions list" => [
            'url' => URL::route('permission.list'),
            "icon" => '<i class="fa fa-lock"></i>'
        ],
        "Add permission" => [
            'url' => URL::route('permission.edit'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});


/**
 *  Recharge sidebar
 */
View::composer(['laravel-authentication-acl::admin.recharge-info.*'], function ($view) {
    $view->with('sidebar_items', [
        " Recharge Histories" => [
            'url' => URL::route('recharge.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " New Recharge" => [
            'url' => URL::route('recharge.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});


/**
 *  View Category sidebar
 */
View::composer(['laravel-authentication-acl::admin.view-category.*'], function ($view) {
    $view->with('sidebar_items', [
        " Category list" => [
            'url' => URL::route('viewcategory.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Category Add" => [
            'url' => URL::route('viewcategory.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});



/**
 *  Setup sidebar
 */
View::composer([
    'laravel-authentication-acl::admin.recharge-type.*',
    'laravel-authentication-acl::admin.variable.*'], function ($view) {
    $view->with('sidebar_items', [
        " Bank List" => [
            'url' => URL::route('recharge-type.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Add New Bank" => [
            'url' => URL::route('recharge-type.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],

        " Global Variables" => [
            'url' => URL::route('variable.edit'),
            "icon" => '<i class="fa fa-edit"></i>'
        ],

    ]);
});


/**
 *  CMS sidebar
 */
View::composer([
    'laravel-authentication-acl::admin.cms.category.*', 
    'laravel-authentication-acl::admin.cms.page.*',
    'laravel-authentication-acl::admin.cms.post.*'], function ($view) {
    $view->with('sidebar_items', [
        " Post list" => [
            'url' => URL::route('post.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Post Add" => [
            'url' => URL::route('post.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],
        " Category list" => [
            'url' => URL::route('category.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Category Add" => [
            'url' => URL::route('category.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],
        " Page list" => [
            'url' => URL::route('page.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Page Add" => [
            'url' => URL::route('page.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});