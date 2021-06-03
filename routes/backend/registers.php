<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => 'backend/registers/', 'middleware' => ['auth','role']], function () {

    #####################RUTA PARA INDUSTRIAS#################################################
    Route::match(['get', 'post'],'/industries', 'Backend\IndustryController@index')
        ->name('industries')
        ->defaults('route', 'industries');

    Route::post('/industries/store', 'Backend\IndustryController@store')
        ->name('store-industries');

    Route::post('/industries/update', 'Backend\IndustryController@update')
        ->name('update-industries');

    Route::get('/industries/edit/{id}', 'Backend\IndustryController@edit')
        ->name('edit-industries')
        ->defaults('route', 'industries');

    Route::get('/industries/create/new', 'Backend\IndustryController@create')
        ->name('create-industries')
        ->defaults('route', 'industries');

    Route::post('/industries/destroy', 'Backend\IndustryController@destroy')
        ->name('destroy-industries');




    #####################RUTA PARA EDUCACION#################################################
    Route::match(['get', 'post'],'/educations', 'Backend\EducationController@index')
        ->name('educations')
        ->defaults('route', 'educations');

    Route::post('/educations/store', 'Backend\EducationController@store')
        ->name('store-educations');

    Route::post('/educations/update', 'Backend\EducationController@update')
        ->name('update-educations');

    Route::get('/educations/edit/{id}', 'Backend\EducationController@edit')
        ->name('edit-educations')
        ->defaults('route', 'educations');

    Route::get('/educations/create/new', 'Backend\EducationController@create')
        ->name('create-educations')
        ->defaults('route', 'educations');

    Route::post('/educations/destroy', 'Backend\EducationController@destroy')
        ->name('destroy-educations');



    #####################RUTA PARA CATEGORIAS#################################################
    Route::match(['get', 'post'],'/categories', 'Backend\CategoryController@index')
        ->name('categories')
        ->defaults('route', 'categories');

    Route::post('/categories/store', 'Backend\CategoryController@store')
        ->name('store-categories');

    Route::post('/categories/update', 'Backend\CategoryController@update')
        ->name('update-categories');

    Route::get('/categories/edit/{id}', 'Backend\CategoryController@edit')
        ->name('edit-categories')
        ->defaults('route', 'categories');

    Route::get('/categories/create/new', 'Backend\CategoryController@create')
        ->name('create-categories')
        ->defaults('route', 'categories');

    Route::post('/categories/destroy', 'Backend\CategoryController@destroy')
        ->name('destroy-categories');


});