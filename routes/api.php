<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', 'API\AuthController@login');
Route::post('/register', 'API\AuthController@register');

//Route::post('/postjob/create','API\PostJobController@store');
//Route::get('/postjob/show','API\PostJobController@show');


//Route::resource('postcv', 'API\PostCvController');
//Route::post('/postcv/create','API\PostCvController@store');
//Route::get('/postcv/show','API\PostCvController@show');


Route::group(["middleware" => ['auth:api']], function () {
    Route::get('/user', 'API\UserController@index');

    Route::resource('postjob', 'API\PostJobController');
    Route::post('/postjob/create','API\PostJobController@store');
    Route::get('/postjob/show','API\PostJobController@show');

    Route::resource('postcv', 'API\PostCvController');
    Route::get('/postcv/show','API\PostCvController@show');
    Route::post('/postcv/create','API\PostCvController@store');


});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// }); 'API\AuthController@login'
