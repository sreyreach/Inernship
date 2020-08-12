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

Route::get('/user', 'API\UserController@index');
Route::get('/user/{id}','API\UserController@show');
Route::post('/user/update/{id}','API\UserController@update');

// Route::post('/postjob/create','API\PostJobController@store');
// Route::post('/postjob/update/{id}','API\PostJobController@update'); 
// Route::delete('/postjob/delete/{id}','API\PostJobController@destroy'); 
// Route::get('/postjob/show/{id}','API\PostJobController@show');
//Route::get('/postjob/read','API\PostJobController@index');
Route::get('/postjob/user/{id}','API\PostJobController@userId');
Route::get('/postjob/getdownload/{id}','API\PostJobController@getDownload'); 



// Route::post('/postcv/create','API\PostCvController@store');
Route::get('/postcv/show/{id}','API\PostCvController@show');
// Route::post('/postcv/update/{id}','API\PostCvController@update');   
// Route::delete('/postcv/delete/{id}','API\PostCvController@destroy');  
//Route::get('/postcv/read','API\PostCvController@index');
Route::get('/postcv/user/{id}','API\PostCvController@userId');
Route::get('/postcv/showPdf/{id}','API\PostCvController@showPDF'); 



Route::group(["middleware" => ['auth:api']], function () {
    // Route::get('/user', 'API\UserController@index');
    // Route::get('/user/{id}','API\UserController@show');

    Route::post('/postjob/create','API\PostJobController@store');
    Route::post('/postjob/update/{id}','API\PostJobController@update'); 
    Route::delete('/postjob/delete/{id}','API\PostJobController@destroy'); 
    Route::get('/postjob/show/{id}','API\PostJobController@show');
    Route::get('/postjob/read','API\PostJobController@index');
   // Route::get('/postcv/user/{id}','API\PostCvController@userId');


    Route::post('/postcv/create','API\PostCvController@store');
    // Route::get('/postcv/show/{id}','API\PostCvController@show');
    Route::post('/postcv/update/{id}','API\PostCvController@update');   
    Route::delete('/postcv/delete/{id}','API\PostCvController@destroy'); 
    Route::get('/postcv/read','API\PostCvController@index'); 
   // Route::get('/postjob/user/{id}','API\PostJobController@userId');

});

