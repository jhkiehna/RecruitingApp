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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', 'AdminController@index')->name('dashboard');

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::prefix('/candidate')->group(function () {
        Route::get('/create-candidate', 'CandidateController@create')->name('create.candidate');
        Route::post('/', 'CandidateController@store')->name('store.candidate');
    });
});

Route::prefix('/employer')->middleware('auth:api')->group(function () {
    Route::get('/', 'EmployerController@index');
    Route::post('/', 'EmployerController@store');
});
