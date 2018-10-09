<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/candidate')->group(function () {
    Route::get('/', 'CandidateController@index');
    Route::post('/', 'CandidateController@store');
});

Route::prefix('/employer')->group(function () {
    Route::get('/', 'EmployerController@index');
    Route::post('/', 'EmployerController@store');
});
