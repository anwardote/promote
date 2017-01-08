<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::group(['prefix' => ''], function () {
    Route::get('/', [
        'middleware' => array('can_see'),
        'as' => 'home',
        'uses' => 'CMSViewController@getHomePage']);
    Route::get('/business/{slug?}', [
        'middleware' => array('can_see'),
        'as' => 'home.business',
        'uses' => 'CMSViewController@getDetail']);
    Route::get('/howtouse', [
        'middleware' => array('can_see'),
        'as' => 'howtouse',
        'uses' => 'CMSViewController@getHowtousePage']);

    Route::get('/howtorecharge', [
        'middleware' => array('can_see'),
        'as' => 'howtorecharge',
        'uses' => 'CMSViewController@getHowtorechargePage']);

    Route::get('/contact-us', [
        'middleware' => array('can_see'),
        'as' => 'contact.form',
        'uses' => 'CMSViewController@getContactUsPage']);
    Route::post('/contact-us', [
        'middleware' => array('can_see'),
        'as' => 'contact.store',
        'uses' => 'ContactController@store']);
});


Route::group(['prefix' => 'admin'], function () {
    /* START Recharge */
    Route::get('/recharge/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_recharge-editor'),
        'as' => 'recharge.list',
        'uses' => 'RechargesController@getAdminList']);

    Route::get('/recharge/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_recharge-editor'),
        'as' => 'recharge.new',
        'uses' => 'RechargesController@getNew']);

    Route::post('/recharge/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_recharge-editor'),
        'as' => 'recharge.new',
        'uses' => 'RechargesController@postNew']);

    Route::get('/recharge/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_recharge-editor'),
        'as' => 'recharge.edit',
        'uses' => 'RechargesController@getUpdate']);

    Route::post('/recharge/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_recharge-editor'),
        'as' => 'recharge.edit',
        'uses' => 'RechargesController@postUpdate']);

    Route::get('/recharge/detail', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_recharge-editor'),
        'as' => 'recharge.detail',
        'uses' => 'RechargesController@getDetail']);

    Route::get('/recharge/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'recharge.delete',
        'uses' => 'RechargesController@delete']);
});


Route::group(['prefix' => 'admin/setup'], function () {

    /* Setup drivers */
    Route::get('/recharge-type/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'recharge-type.list',
        'uses' => 'RechargeTypeController@getList']);

    Route::get('/recharge-type/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'recharge-type.new',
        'uses' => 'RechargeTypeController@getNew']);

    Route::post('/recharge-type/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'recharge-type.new',
        'uses' => 'RechargeTypeController@postNew']);

    Route::get('/recharge-type/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'recharge-type.edit',
        'uses' => 'RechargeTypeController@getUpdate']);

    Route::post('/recharge-type/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'recharge-type.edit',
        'uses' => 'RechargeTypeController@postUpdate']);

    Route::get('/recharge-type/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'recharge-type.delete',
        'uses' => 'RechargeTypeController@delete']);

    /* Setup Variables */
     Route::get('/variable/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'variable.edit',
        'uses' => 'VariablesController@getUpdate']);

    Route::post('/variable/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'variable.edit',
        'uses' => 'VariablesController@postUpdate']);
});


Route::group(['prefix' => 'admin/cms'], function () {

    /*Post CMS */
    Route::get('/post/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'post.list',
        'uses' => 'PostsController@getList']);

    Route::get('/post/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'post.new',
        'uses' => 'PostsController@getNew']);

    Route::post('/post/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'post.new',
        'uses' => 'PostsController@postNew']);

    Route::get('/post/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'post.edit',
        'uses' => 'PostsController@getUpdate']);

    Route::post('/post/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'post.edit',
        'uses' => 'PostsController@postUpdate']);

    Route::get('/post/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'post.delete',
        'uses' => 'PostsController@delete']);


    /*Page CMS */
    Route::get('/page/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'page.list',
        'uses' => 'PagesController@getList']);

    Route::get('/page/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'page.new',
        'uses' => 'PagesController@getNew']);

    Route::post('/page/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'page.new',
        'uses' => 'PagesController@postNew']);

    Route::get('/page/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'page.edit',
        'uses' => 'PagesController@getUpdate']);

    Route::post('/page/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'page.edit',
        'uses' => 'PagesController@postUpdate']);

    Route::get('/page/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'page.delete',
        'uses' => 'PagesController@delete']);


    /*Category CMS */
    Route::get('/category/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'category.list',
        'uses' => 'CategoriesController@getList']);

    Route::get('/category/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'category.new',
        'uses' => 'CategoriesController@getNew']);

    Route::post('/category/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'category.new',
        'uses' => 'CategoriesController@postNew']);

    Route::get('/category/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'category.edit',
        'uses' => 'CategoriesController@getUpdate']);

    Route::post('/category/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_cms'),
        'as' => 'category.edit',
        'uses' => 'CategoriesController@postUpdate']);

    Route::get('/category/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'category.delete',
       'uses' => 'CategoriesController@delete']);
});

