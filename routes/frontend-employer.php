<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => '/', 'middleware' => ['auth', 'check_role_dashboard']], function () {

    #RUTAS PARA TRABAJOS

    Route::match(['get', 'post'], 'jobs', 'Employer\JobsController@index')
        ->name('jobs')
        ->middleware('check_role_view_fronted_candidate');


    Route::match(['get', 'post'], 'job-detail/{slug}', 'Employer\JobsController@jobDetail')
        ->name('job-detail')
        ->middleware('check_role_view_fronted_candidate');


    Route::match(['get', 'post'], 'jobs-list', 'Employer\JobsController@jobLists')
        ->name('jobs-list')
        ->middleware('check_role_view_fronted_candidate');


    Route::match(['get', 'post'], 'post-a-job', 'Employer\PostAJobController@index')
        ->name('post-a-job')
        ->middleware('check_role_view_fronted_employer');


    Route::match(['get', 'post'], 'edit-post-a-job/{slug}', 'Employer\PostAJobController@editPostAJob')
        ->name('edit-post-a-job')
        ->middleware('check_role_view_fronted_employer');


    Route::match(['get', 'post'], 'save-job', 'Employer\JobsController@store')->name('save-job');


    Route::match(['get', 'post'], 'edit-job', 'Employer\JobsController@update')->name('edit-job');


    Route::match(['get', 'post'], 'my-posts', 'Employer\JobsController@myPosts')
        ->name('my-posts')
        ->middleware('check_role_view_fronted_employer');


    Route::match(['get', 'post'], 'deleted-post', 'Employer\JobsController@postDeleted')->name('deleted-post');


    Route::match(['get', 'post'], 'candidate-applications/{id}', 'Employer\JobsController@candidateApplications')
        ->name('candidate-applications')
        ->middleware('check_role_view_fronted_employer');

    ###############


    #RUTAS PARA COMPAñIAS

    Route::match(['get', 'post'], 'company', 'Employer\CompanyProfileController@index')
        ->name('company-profile')
        ->middleware('check_role_view_fronted_employer');



    Route::match(['get', 'post'], 'company-edit/{slug}', 'Employer\CompanyProfileController@edit')
        ->name('company-edit')
        ->middleware('check_role_view_fronted_employer');



    Route::match(['get', 'post'], 'update-company', 'Employer\CompanyProfileController@update')
        ->name('update-company-profile')
        ->middleware('check_role_view_fronted_employer');



    Route::match(['get', 'post'], 'company-list', 'Employer\CompanyProfileController@listCompanies')
        ->name('company-list')
        ->middleware('check_role_view_fronted_employer');



    Route::match(['get', 'post'], 'save-company-profile', 'Employer\CompanyProfileController@store')->name('save-company-profile');


    Route::match(['get', 'post'], 'company-detail', 'Employer\CompanyDetailController@index')
        ->name('company-detail')
        ->middleware('check_role_view_fronted_employer');



    Route::match(['get', 'post'], 'deleted-company', 'Employer\CompanyProfileController@companyDeleted')->name('deleted-company');


    Route::match(['get', 'post'], 'company-detail-profile/{slug}', 'Employer\CompanyProfileController@profileDetailCompany')
        ->name('candidate-detail-profile')
        ->middleware('check_role_view_fronted_employer');

    #################


    #PERFIL DEL EMPLEADOR
    Route::match(['get', 'post'], 'employer-profile', 'Employer\EmployerProfileController@index')
        ->name('employer-profile')
        ->middleware('check_role_view_fronted_employer');

    Route::match(['get', 'post'], 'update-employer-profile', 'Employer\EmployerProfileController@updateEmployerProfile')
        ->name('update-employer-profile');


    #################
});