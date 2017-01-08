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
    'laravel-authentication-acl::admin.recharge-info.new-admin',
    'laravel-authentication-acl::admin.recharge-info.edit-admin',
    'laravel-authentication-acl::admin.recharge-info.new',
    'laravel-authentication-acl::admin.recharge-info.edit'
], function ($view) {
    $fh = new FormHelper();
    $values_recharge_type_output = $fh->getSelectRechargeTypeOutputValues();
    $view->with('recharge_type_output_values', $values_recharge_type_output);
});


/**
 * recharge output select
 */
View::composer([
    'laravel-authentication-acl::admin.recharge-info.new-admin',
    'laravel-authentication-acl::admin.recharge-info.edit-admin',
    'laravel-authentication-acl::admin.recharge-info.new',
    'laravel-authentication-acl::admin.recharge-info.edit'
], function ($view) {
    $fh = new FormHelper();
    $values_user_info_output = $fh->getSelectUserInfoOutputValues();
    $view->with('user_info_output_values', $values_user_info_output);
});


/**
 * Recharge info output select
 */
View::composer([
    'laravel-authentication-acl::admin.recharge-info.new-admin',
    'laravel-authentication-acl::admin.recharge-info.edit-admin',
    'laravel-authentication-acl::admin.recharge-info.new',
    'laravel-authentication-acl::admin.recharge-info.edit',
    'laravel-authentication-acl::admin.layouts.footer',
          ], function ($view) {
    $fh = new FormHelper();
    $values_status_output = $fh->getSelectstatusOutputValues();
    $view->with('status_values', $values_status_output);
});


/**
 * Variables info
 */
View::composer([
    'laravel-authentication-acl::admin.layouts.footer',
], function ($view) {
    $fh = new FormHelper();
    $values_var_output = $fh->getVariablesOutputValues();
    $view->with('variables_values', $values_var_output);
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
