<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/backend/login', function () {
    return view('auth.login');
});

Route::match(['get', 'post'], '/verfify-login-user', 'Auth\LoginController@login')->name('verfify-login-user');

Route::group(['middleware' => ['auth','role']], function () {
    Route::get('backend', 'Backend\DashboardController@index')->name('backend');
});