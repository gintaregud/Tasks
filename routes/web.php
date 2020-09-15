<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', 'StatusController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('tasks', 'TaskController');
Route::resource('statuses', 'StatusController');

Route::middleware(['auth'])->group(function () {
    Route::resource('task', 'TaskController');
    Route::resource('statuses', 'StatusController');
});
