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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user','UserController'); 
Route::get('/user/{id}/destroy', 'UserController@destroy');

Route::resource('employer','EmployerController');
Route::get('/employer/{id}/destroy', 'EmployerController@destroy');


Route::resource('employees', 'employeesController');
Route::get('/employees/{id}/destroy','EmployeesController@destroy');

Route::resource('post_job','PostJobController');
Route::get('/post_job/{id}/destroy','PostJobController@destroy');

Route::resource('post_cv','PostCvController');
Route::get('/post_cv/{id}/destroy','PostCvController@destroy');

Route::get('/search', 'UserController@search');
Route::get('/search', 'EmployerController@search');
Route::get('/search', 'EmployeesController@search');