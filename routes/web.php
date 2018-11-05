<?php

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

//Auth routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'AdminController@index')->name('dashboard');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::prefix('/candidates')->group(function () {
        Route::get('/', 'CandidateController@index')->name('index.candidates');
        Route::get('/create-candidate', 'CandidateController@create')->name('create.candidate');
        Route::post('/', 'CandidateController@store')->name('store.candidate');
        Route::get('{candidateId}/edit-candidate', 'CandidateController@edit')->name('edit.candidate');
        Route::post('{candidateId}/update-candidate', 'CandidateController@update')->name('update.candidate');
    });

    Route::prefix('/employers')->group(function () {
        Route::get('/', 'EmployerController@index')->name('index.employers');
        Route::get('/create-employer', 'EmployerController@create')->name('create.employer');
        Route::post('/', 'EmployerController@store')->name('store.employer');
    });

    Route::post('/sendClientNotification/{employerId}', 'NotifyClientController@send')->name('email.client');
    Route::post('/sendCandidateNotification/{candidateId}', 'NotifyClientController@send')->name('email.candidate');
});
