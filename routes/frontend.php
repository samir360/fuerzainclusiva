<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::match(['get', 'post'], '/home', 'Auth\LoginController@showHomeFrmLogin')->name('login-user');
Route::match(['get', 'post'], '/', 'Auth\LoginController@showFrmLogin')->name('login-user');
Route::match(['get', 'post'], 'dashboard/logout', 'Auth\LoginController@logout')->name('logout');
Route::match(['get', 'post'], 'dashboard/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::match(['get', 'post'], 'dashboard/save-user', 'Auth\RegisterController@store')->name('save-user');


##################### RUTA RECUPERAR CONTRASEñA ####################################################
Route::match(['get', 'post'],'password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetFormRetailer')->name('password.reset_retailer');
Route::match(['get', 'post'],'password/update_password/', 'Auth\ResetPasswordController@resetPasswordRetailer')
    ->name('password.update');


#RUTAS PARA CONTACTO

Route::match(['get', 'post'], 'contact', 'ContactController@index')->name('contact');

Route::match(['get', 'post'], 'save-contact', 'ContactController@saveContact')->name('save-contact');

#################