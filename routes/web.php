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

Route::resource('users', 'UserController');
Route::get('users/{user}/block', 'UserController@block')->name('block');

Route::resource('roles', 'RoleController');

Route::resource('checkLists', 'CheckListController');

Route::resource('checkLists.itemCheckLists', 'ItemCheckListController')->shallow();

//Route::resource('itemCheckLists', 'ItemCheckListController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
