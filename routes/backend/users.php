<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => 'backend/users/', 'middleware' => ['auth','role']], function () {

    #####################RUTA PARA USUARIOS#################################################
    Route::get('/user', 'Backend\UserController@index')
        ->name('user')
        ->defaults('route', 'user');

    Route::post('/user/store', 'Backend\UserController@store')
        ->name('store');

    Route::post('/user/update', 'Backend\UserController@update')
        ->name('update');

    Route::get('/user/edit/{id}', 'Backend\UserController@edit')
        ->name('edit_user')
        ->defaults('route', 'user');

    Route::get('/user/create/new', 'Backend\UserController@create')
        ->name('create_user')
        ->defaults('route', 'user');

    Route::post('/user/destroy', 'Backend\UserController@destroy')
        ->name('destroyUser');
});