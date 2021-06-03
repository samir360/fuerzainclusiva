<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::group(['prefix' => '/', 'middleware' => ['auth', 'check_role_dashboard']], function () {

    #RUTAS PARA CANDIDATOS

    Route::match(['get', 'post'], 'candidates', 'Candidate\CandidateProfileController@index')
        ->name('candidate')
    ->middleware('check_role_view_fronted_employer');


    Route::match(['get', 'post'], 'candidate-list', 'Candidate\CandidateProfileController@candidateList')
        ->name('candidate-list')
    ->middleware('check_role_view_fronted_employer');



    Route::match(['get', 'post'], 'candidate-profile', 'Candidate\CandidateProfileController@profileCandidate')
        ->name('candidate-profile')
        ->middleware('check_role_view_fronted_candidate');



    Route::match(['get', 'post'], 'candidate-detail-profile/{slug}', 'Candidate\CandidateProfileController@profileDetailCandidate')
        ->name('candidate-detail-profile')
    ->middleware('check_role_view_fronted_employer');



    Route::match(['get', 'post'], 'save-candidate-profile', 'Candidate\CandidateProfileController@saveProfile')->name('save-candidate-profile');

    Route::match(['get', 'post'], 'update-candidate-profile', 'Candidate\CandidateProfileController@updateProfile')->name('update-candidate-profile');

    Route::match(['get', 'post'], 'job-apply', 'Candidate\ApplicationController@saveApplication')->name('job-apply');

    Route::match(['get', 'post'], 'my-applications', 'Candidate\ApplicationController@index')
        ->name('my-applications')
        ->middleware('check_role_view_fronted_candidate');


    #RUTAS PARA INSTITUTIONS
    Route::match(['get', 'post'], 'ajax-institution-lists', 'Candidate\InstitutionProfileController@index')
        ->name('ajax-institution-lists');

    Route::match(['get', 'post'], 'save-institution-profile', 'Candidate\InstitutionProfileController@saveInstitutionProfile')
        ->name('save-institution-profile');

    Route::match(['get', 'post'], 'delete-institution', 'Candidate\InstitutionProfileController@deleteInstitution')
        ->name('delete-institution');


    #RUTAS PARA EXPERIENCE
    Route::match(['get', 'post'], 'ajax-experience-lists', 'Candidate\ExperienceProfileController@index')
        ->name('ajax-experience-lists');

    Route::match(['get', 'post'], 'save-experience-profile', 'Candidate\ExperienceProfileController@saveExperienceProfile')
        ->name('save-experience-profile');

    Route::match(['get', 'post'], 'delete-experience', 'Candidate\ExperienceProfileController@deleteExperience')
        ->name('delete-experience');


    #RUTAS PARA PERSONAL REFERENCES
    Route::match(['get', 'post'], 'ajax-reference-lists', 'Candidate\ReferenceProfileController@index')
        ->name('ajax-reference-lists');

    Route::match(['get', 'post'], 'save-reference-profile', 'Candidate\ReferenceProfileController@saveReferenceProfile')
        ->name('save-reference-profile');

    Route::match(['get', 'post'], 'delete-reference', 'Candidate\ReferenceProfileController@deleteReference')
        ->name('delete-reference');

    ##############







});




