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
 *  Firmware sidebar
 */
View::composer(['laravel-authentication-acl::admin.firmware.*'], function ($view) {
    $view->with('sidebar_items', [
        " Firmware list" => [
            'url' => URL::route('firmware.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Firmware Add" => [
            'url' => URL::route('firmware.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});



/**
 *  Driver sidebar
 */
View::composer(['laravel-authentication-acl::admin.driver.*'], function ($view) {
    $view->with('sidebar_items', [
        " Driver list" => [
            'url' => URL::route('driver.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Driver Add" => [
            'url' => URL::route('driver.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});

/**
 *  Tool sidebar
 */
View::composer(['laravel-authentication-acl::admin.tool.*'], function ($view) {
    $view->with('sidebar_items', [
        " Tool list" => [
            'url' => URL::route('tool.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Tool Add" => [
            'url' => URL::route('tool.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
    ]);
});


/**
 *  Tutorial sidebar
 */
View::composer(['laravel-authentication-acl::admin.tutorial.*'], function ($view) {
    $view->with('sidebar_items', [
        " Tutorial list" => [
            'url' => URL::route('tutorial.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Tutorial Add" => [
            'url' => URL::route('tutorial.new'),
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
    'laravel-authentication-acl::admin.device.*',
    'laravel-authentication-acl::admin.driver-name.*',
    'laravel-authentication-acl::admin.driver-type.*'], function ($view) {
    $view->with('sidebar_items', [
        " Type List" => [
            'url' => URL::route('recharge-type.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Type Add" => [
            'url' => URL::route('recharge-type.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],


        " Device list" => [
            'url' => URL::route('device.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Device Add" => [
            'url' => URL::route('device.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],
        " Driver Name list" => [
            'url' => URL::route('driver-name.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Driver Name Add" => [
            'url' => URL::route('driver-name.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ],
        " Driver Type list" => [
            'url' => URL::route('driver-type.list'),
            "icon" => '<i class="fa fa-th-list"></i>'
        ],
        " Driver Type Add" => [
            'url' => URL::route('driver-type.new'),
            "icon" => '<i class="fa fa-plus-circle"></i>'
        ]
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