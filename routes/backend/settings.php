<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => 'backend/system_settings/', 'middleware' => ['auth','role']], function () {

    #####################RUTA PARA MENU####################################
    Route::get('menu', 'Backend\MenuController@index')
        ->name('menu')
        ->defaults('route', 'menu');

    Route::get('menu/edit/{id}', 'Backend\MenuController@edit')
        ->name('edit_menu')
        ->defaults('route', 'menu');

    Route::get('menu/create/new', 'Backend\MenuController@create')
        ->name('create_menu')
        ->defaults('route', 'menu');

    Route::post('menu/store', 'Backend\MenuController@store')
        ->name('storeMenu');

    Route::post('menu/update', 'Backend\MenuController@update')
        ->name('updateMenu');

    Route::post('menu/update-position', 'Backend\MenuController@update')
        ->name('update-position')
        ->defaults('position', 1);

    Route::get('menu/details', 'Backend\MenuController@index')
        ->name('menu-details')
        ->defaults('route', 1);

    Route::post('menu/destroy', 'Backend\MenuController@destroy')
        ->name('destroy-menu');


    #####################RUTA PARA SUB MENU####################################
    Route::get('submenu', 'Backend\SubMenuController@index')
        ->name('submenu')
        ->defaults('route', 'submenu');

    Route::get('submenu/edit/{id}', 'Backend\SubMenuController@edit')
        ->name('edit_submenu')
        ->defaults('route', 'submenu');

    Route::post('submenu/update', 'Backend\SubMenuController@update')
        ->name('updateSubMenu');

    Route::post('submenu/destroy', 'Backend\SubMenuController@destroy')
        ->name('destroySubMenu');

    Route::match(['get', 'post'], 'submenu_filtered', 'SubMenuController@index')
        ->name('submenu_filtered');


    ######################RUTA PARA ROLES###############################
    Route::get('/roles', 'Backend\RolController@index')
        ->name('rol')
        ->defaults('route', 'rol');

    Route::post('/roles/store', 'Backend\RolController@store')
        ->name('storeRol');

    Route::post('/roles/update', 'Backend\RolController@update')
        ->name('updateRol');

    Route::get('/roles/edit/{id}', 'Backend\RolController@edit')
        ->name('edit_rol')
        ->defaults('route', 'rol');

    Route::get('/roles/create/new', 'Backend\RolController@create')
        ->name('create_rol')
        ->defaults('route', 'rol');

    Route::post('/roles/destroy', 'Backend\RolController@destroy')
        ->name('destroyRol');

    Route::match(['get', 'post'], '/list_permission_role', 'Backend\UserController@listPermissionRole')
        ->name('listPermissionRole');



    ######################RUTA PARA ACTIVITY LOGO###############################
    Route::get('/activity_log', 'Backend\ActivityLogController@index')
        ->name('activity_log')
        ->defaults('route', 'activity_log');

    Route::post('/activity_log/store', 'Backend\ActivityLogController@store')
        ->name('storeActivityLog');

    Route::post('/activity_log/destroy', 'Backend\ActivityLogController@destroy')
        ->name('destroyActivityLog');

});