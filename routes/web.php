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


//    'uses' => 'CMSViewController@getToolPage']);


    Route::get('/firmware', [
        'middleware' => array('can_see'),
        'as' => 'firmware',
        'uses' => 'CMSViewController@getFirmwarePage']);

    Route::get('/tutorials', [
        'middleware' => array('can_see'),
        'as' => 'tutorial',
        'uses' => 'CMSViewController@getTutorialPage']);

    Route::get('/drivers', [
        'middleware' => array('can_see'),
        'as' => 'driver',
        'uses' => 'CMSViewController@getDriverPage']);

    Route::get('/tools', [
        'middleware' => array('can_see'),
        'as' => 'tool',
        'uses' => 'CMSViewController@getToolPage']);

    Route::get('/contact-us', [
        'middleware' => array('can_see'),
        'as' => 'contact.form',
        'uses' => 'ContactController@create']);
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






    /* START Formware */
    Route::get('/firmware/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_firmware-editor'),
        'as' => 'firmware.list',
        'uses' => 'FirmwaresController@getAdminList']);

    Route::get('/firmware/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_firmware-editor'),
        'as' => 'firmware.new',
        'uses' => 'FirmwaresController@getNew']);

    Route::post('/firmware/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_firmware-editor'),
        'as' => 'firmware.new',
        'uses' => 'FirmwaresController@postNew']);

    Route::get('/firmware/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_firmware-editor'),
        'as' => 'firmware.edit',
        'uses' => 'FirmwaresController@getUpdate']);

    Route::post('/firmware/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_firmware-editor'),
        'as' => 'firmware.edit',
        'uses' => 'FirmwaresController@postUpdate']);

    Route::get('/firmware/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'firmware.delete',
        'uses' => 'FirmwaresController@delete']);

    /* START Driver */
    Route::get('/driver/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_driver-editor'),
        'as' => 'driver.list',
        'uses' => 'DriversController@getAdminList']);

    Route::get('/driver/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_driver-editor'),
        'as' => 'driver.new',
        'uses' => 'DriversController@getNew']);

    Route::post('/driver/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_driver-editor'),
        'as' => 'driver.new',
        'uses' => 'DriversController@postNew']);

    Route::get('/driver/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_driver-editor'),
        'as' => 'driver.edit',
        'uses' => 'DriversController@getUpdate']);

    Route::post('/driver/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_driver-editor'),
        'as' => 'driver.edit',
        'uses' => 'DriversController@postUpdate']);

    Route::get('/driver/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'driver.delete',
        'uses' => 'DriversController@delete']);

    /* START Tool */
    Route::get('/tool/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tool-editor'),
        'as' => 'tool.list',
        'uses' => 'ToolsController@getAdminList']);

    Route::get('/tool/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tool-editor'),
        'as' => 'tool.new',
        'uses' => 'ToolsController@getNew']);

    Route::post('/tool/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tool-editor'),
        'as' => 'tool.new',
        'uses' => 'ToolsController@postNew']);

    Route::get('/tool/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tool-editor'),
        'as' => 'tool.edit',
        'uses' => 'ToolsController@getUpdate']);

    Route::post('/tool/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tool-editor'),
        'as' => 'tool.edit',
        'uses' => 'ToolsController@postUpdate']);

    Route::get('/tool/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'tool.delete',
        'uses' => 'ToolsController@delete']);

    /* Tutorial */
    Route::get('/tutorial/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tutorial-editor'),
        'as' => 'tutorial.list',
        'uses' => 'TutorialsController@getAdminList']);

    Route::get('/tutorial/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tutorial-editor'),
        'as' => 'tutorial.new',
        'uses' => 'TutorialsController@getNew']);

    Route::post('/tutorial/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tutorial-editor'),
        'as' => 'tutorial.new',
        'uses' => 'TutorialsController@postNew']);

    Route::get('/tutorial/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tutorial-editor'),
        'as' => 'tutorial.edit',
        'uses' => 'TutorialsController@getUpdate']);

    Route::post('/tutorial/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_tutorial-editor'),
        'as' => 'tutorial.edit',
        'uses' => 'TutorialsController@postUpdate']);

    Route::get('/tutorial/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'tutorial.delete',
        'uses' => 'TutorialsController@delete']);

    /* View Category */
    Route::get('/category/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_category-editor'),
        'as' => 'viewcategory.list',
        'uses' => 'ViewCategoryController@getAdminList']);

    Route::get('/category/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_category-editor'),
        'as' => 'viewcategory.new',
        'uses' => 'ViewCategoryController@getNew']);

    Route::post('/category/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_category-editor'),
        'as' => 'viewcategory.new',
        'uses' => 'ViewCategoryController@postNew']);

    Route::get('/category/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_category-editor'),
        'as' => 'viewcategory.edit',
        'uses' => 'ViewCategoryController@getUpdate']);

    Route::post('/category/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_category-editor'),
        'as' => 'viewcategory.edit',
        'uses' => 'ViewCategoryController@postUpdate']);

    Route::get('/category/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'viewcategory.delete',
        'uses' => 'ViewCategoryController@delete']);
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



    /* Setup device */
    Route::get('/device/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'device.list',
        'uses' => 'DevicesController@getList']);

    Route::get('/device/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'device.new',
        'uses' => 'DevicesController@getNew']);

    Route::post('/device/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'device.new',
        'uses' => 'DevicesController@postNew']);

    Route::get('/device/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'device.edit',
        'uses' => 'DevicesController@getUpdate']);

    Route::post('/device/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'device.edit',
        'uses' => 'DevicesController@postUpdate']);

    Route::get('/device/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'device.delete',
        'uses' => 'DevicesController@delete']);
    /* Setup drivers */
    Route::get('/driver-name/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-name.list',
        'uses' => 'DriverNamesController@getList']);

    Route::get('/driver-name/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-name.new',
        'uses' => 'DriverNamesController@getNew']);

    Route::post('/driver-name/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-name.new',
        'uses' => 'DriverNamesController@postNew']);

    Route::get('/driver-name/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-name.edit',
        'uses' => 'DriverNamesController@getUpdate']);

    Route::post('/driver-name/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-name.edit',
        'uses' => 'DriverNamesController@postUpdate']);

    Route::get('/driver-name/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'driver-name.delete',
        'uses' => 'DriverNamesController@delete']);
    /* Setup driver Type */
    Route::get('/driver-type/list', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-type.list',
        'uses' => 'DriverTypesController@getList']);

    Route::get('/driver-type/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-type.new',
        'uses' => 'DriverTypesController@getNew']);

    Route::post('/driver-type/new', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-type.new',
        'uses' => 'DriverTypesController@postNew']);

    Route::get('/driver-type/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-type.edit',
        'uses' => 'DriverTypesController@getUpdate']);

    Route::post('/driver-type/edit', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_setup'),
        'as' => 'driver-type.edit',
        'uses' => 'DriverTypesController@postUpdate']);

    Route::get('/driver-type/delete', [
        'middleware' => array('can_see', 'admin_logged', 'has_perm:_delete'),
        'as' => 'driver-type.delete',
        'uses' => 'DriverTypesController@delete']);
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

Route::group(['prefix' => 'firmware'], function () {
    /* START Formware */
    Route::get('view-category/{deviceType?}', [
        'middleware' => array('can_see'),
        'as' => 'firmware.category',
        'uses' => 'ViewCategoryController@getFirmwareCategoryView']);

    Route::get('category/{view_category_id?}', [
        'middleware' => array('can_see'),
        'as' => 'firmware.category.firmware',
        'uses' => 'FirmwaresController@getFirmware']);

});

Route::group(['prefix' => 'tutorial'], function () {
    /* START Tutorial */
    Route::get('view-category/{viewType?}', [
        'middleware' => array('can_see'),
        'as' => 'tutorial.category',
        'uses' => 'CMSViewController@getTutorialCategoryView']);

    Route::get('category/{id?}', [
        'middleware' => array('can_see'),
        'as' => 'tutorial.category.tutorial',
        'uses' => 'TutorialsController@getTutorial']);

});

Route::group(['prefix' => 'driver'], function () {
    /* START Driver */
    Route::get('view-category/{driverType?}', [
        'middleware' => array('can_see'),
        'as' => 'driver.category',
        'uses' => 'ViewCategoryController@getDriverCategoryView']);

    Route::get('category/{view_category_id?}', [
        'middleware' => array('can_see'),
        'as' => 'driver.category.driver',
        'uses' => 'DriversController@getDriver']);

});

Route::group(['prefix' => 'tool'], function () {
    /* START Tutorial */
    Route::get('view-category/{viewType?}', [
        'middleware' => array('can_see'),
        'as' => 'tool.category',
        'uses' => 'CMSViewController@getToolCategoryView']);

    Route::get('category/{id?}', [
        'middleware' => array('can_see'),
        'as' => 'tool.category.tool',
        'uses' => 'ToolsController@getTool']);

});
