<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => 'backend/landing-page/', 'middleware' => ['auth','role']], function () {

    #####################RUTA PARA PAGINAS ESTATICAS#################################################
    Route::get('static-page', 'Backend\StaticPageController@index')
        ->name('static-page')
        ->defaults('route', 'static-page');

    Route::get('static-page/create/new', 'Backend\StaticPageController@create')
        ->name('create-static-page')
        ->defaults('route', 'static-page');

    Route::post('static-page/store', 'Backend\StaticPageController@store')
        ->name('store-static-page');

    Route::get('static-page/edit/{id}', 'Backend\StaticPageController@edit')
        ->name('edit-static-page')
        ->defaults('route', 'static-page');

    Route::post('static-page/update', 'Backend\StaticPageController@update')
        ->name('update-static-page');

    Route::post('static-page/destroy', 'Backend\StaticPageController@destroy')
        ->name('destroy-static-page');



    #####################RUTA PARA PREGUNTAS FRECUENTES###############################
    Route::get('faq', 'Backend\FaqController@index')
        ->name('faq')
        ->defaults('route', 'faq');

    Route::get('faq/create/new', 'Backend\FaqController@create')
        ->name('create-faq')
        ->defaults('route', 'faq');

    Route::post('faq/store', 'Backend\FaqController@store')
        ->name('store-faq');

    Route::get('faq/edit/{id}', 'Backend\FaqController@edit')
        ->name('edit-faq')
        ->defaults('route', 'faq');

    Route::post('faq/update', 'Backend\FaqController@update')
        ->name('update-faq');

    Route::post('faq/update-faq', 'Backend\FaqController@update')->name('updateFaqs')
        ->defaults('orden', 1);

    Route::get('faq/details', 'Backend\FaqController@index')
        ->name('faq-details')
        ->defaults('route', 1);

    Route::post('faq/destroy', 'Backend\FaqController@destroy')
        ->name('destroy-faq');
});