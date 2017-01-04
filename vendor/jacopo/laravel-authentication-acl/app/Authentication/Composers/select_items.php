<?php

use LaravelAcl\Authentication\Helpers\FormHelper;

/**
 * permission select
 */
View::composer(['laravel-authentication-acl::admin.user.edit', 'laravel-authentication-acl::admin.group.edit'], function ($view) {
    $fh = new FormHelper();
    $values_permission = $fh->getSelectValuesPermission();
    $view->with('permission_values', $values_permission);
});
/**
 * group select
 */
View::composer(['laravel-authentication-acl::admin.user.edit', 'laravel-authentication-acl::admin.group.edit',
    'laravel-authentication-acl::admin.user.search'], function ($view) {
    $fh = new FormHelper();
    $values_group = $fh->getSelectValuesGroups();
    $view->with('group_values', $values_group);
});


/**
 * recharge output select
 */
View::composer([
    'laravel-authentication-acl::admin.recharge.new2',
    'laravel-authentication-acl::admin.recharge.edit'
], function ($view) {
    $fh = new FormHelper();
    $values_recharge_type_output = $fh->getSelectRechargeTypeOutputValues();
    $view->with('recharge_type_output_values', $values_recharge_type_output);
});


/**
 * firmware output select
 */
View::composer([
    'laravel-authentication-acl::admin.firmware.new',
    'laravel-authentication-acl::admin.firmware.edit',
    'laravel-authentication-acl::admin.firmware.list'
        ], function ($view) {
    $fh = new FormHelper();
    $values_country_output = $fh->getSelectCountryOutputValues();
    $view->with('country_output_values', $values_country_output);
});


/**
 * driver output select
 */
View::composer([
    'laravel-authentication-acl::admin.driver.new',
    'laravel-authentication-acl::admin.driver.edit',
    'laravel-authentication-acl::admin.driver.list'
        ], function ($view) {
    $fh = new FormHelper();
    $values_driver_name_output = $fh->getSelectDriverNameOutputValues();
    $view->with('driverName_output_values', $values_driver_name_output);
});

/**
 * Fcategory output select
 */
View::composer([
    'laravel-authentication-acl::admin.firmware.new',
    'laravel-authentication-acl::admin.firmware.edit',
    'laravel-authentication-acl::admin.firmware.list',
    'laravel-authentication-acl::admin.view-category.new',
    'laravel-authentication-acl::admin.view-category.edit',
    'laravel-authentication-acl::admin.view-category.list'
        ], function ($view) {
    $fh = new FormHelper();
    $values_fcategory_output = $fh->getSelectfcategoryOutputValues();
    $view->with('fcategory_output_values', $values_fcategory_output);
});

/**
 * Device output select
 */
View::composer([
    'laravel-authentication-acl::admin.firmware.new',
    'laravel-authentication-acl::admin.firmware.edit',
    'laravel-authentication-acl::admin.firmware.list'
        ], function ($view) {
    $fh = new FormHelper();
    $values_device_output = $fh->getSelectdeviceOutputValues();
    $view->with('device_output_values', $values_device_output);
});

/**
 * Device output select
 */
View::composer([
    'laravel-authentication-acl::admin.tool.new',
    'laravel-authentication-acl::admin.tool.edit',
    'laravel-authentication-acl::admin.tool.list'
        ], function ($view) {
    $fh = new FormHelper();
    $values_tool_support_output = $fh->getSelectToolSupportOutputValues();
    $view->with('tool_support_output_values', $values_tool_support_output);
});


/**
 * Device output select
 */
View::composer([
    'laravel-authentication-acl::admin.recharge-info.new',
    'laravel-authentication-acl::admin.recharge-info.edit',
    'laravel-authentication-acl::admin.recharge.edit',
    'laravel-authentication-acl::admin.firmware.new',
    'laravel-authentication-acl::admin.firmware.edit',
    'laravel-authentication-acl::admin.firmware.list',
    'laravel-authentication-acl::admin.driver.new',
    'laravel-authentication-acl::admin.driver.edit',
    'laravel-authentication-acl::admin.driver.list',
    'laravel-authentication-acl::admin.tool.new',
    'laravel-authentication-acl::admin.tool.edit',
    'laravel-authentication-acl::admin.tool.list'
        ], function ($view) {
    $fh = new FormHelper();
    $values_status_output = $fh->getSelectstatusOutputValues();
    $view->with('status_values', $values_status_output);
});


/**
 * driver name type output select
 */
View::composer([
    'laravel-authentication-acl::admin.driver-name.new',
    'laravel-authentication-acl::admin.driver-name.edit',
    'laravel-authentication-acl::admin.driver-name.list',
    'laravel-authentication-acl::admin.driver.new',
    'laravel-authentication-acl::admin.driver.edit',
    'laravel-authentication-acl::admin.driver.list'
        ], function ($view) {
    $fh = new FormHelper();
    $values_type_output = $fh->getSelectdriverTypeOutputValues();
    $view->with('driver_type_values', $values_type_output);
});


/**
 * CMS
 * Category Select Value
 */
View::composer([
    'laravel-authentication-acl::admin.cms.category.new',
    'laravel-authentication-acl::admin.cms.category.edit',
    'laravel-authentication-acl::admin.cms.category.list',
    'laravel-authentication-acl::admin.cms.post.new',
    'laravel-authentication-acl::admin.cms.post.edit'
        ], function ($view) {
    $fh = new FormHelper();
    $values_cms_category_output = $fh->getSelectCmsCategoryOutputValues();
    $view->with('cms_category_values', $values_cms_category_output);
});
