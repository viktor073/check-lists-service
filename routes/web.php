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

Route::middleware(['auth'])->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');

	//
	//Route UserController
	//
	Route::get('users/{user}/block', 'UserController@block')->name('block');

	Route::resource('users', 'UserController')
		->middleware('canResource:App\User,user');
	//
	//END - Route UserController
	//

	Route::resource('roles', 'RoleController')->middleware('canResource:App\Role,role');

	Route::resource('checkLists.itemCheckLists', 'ItemCheckListController')
		->shallow()
		->middleware('canResource:App\ItemCheckList,itemCheckList');

	//
	//Route CheckListController
	//
	Route::get('checkLists', 'CheckListController@index')
		->name('checkLists.index')
		->middleware('can:viewAny,App\CheckList');

	Route::get('checkLists/create', 'CheckListController@create')
		->name('checkLists.create')
		->middleware('can:create,App\CheckList');

	Route::get('checkLists/{checkList}', 'CheckListController@show')
		->name('checkLists.show')
		->middleware('can:view,checkList');

	Route::post('checkLists', 'CheckListController@store')
		->name('checkLists.store')
		->middleware('can:create,App\CheckList');

	Route::delete('checkLists/{checkList}', 'CheckListController@destroy')
		->name('checkLists.destroy')
		->middleware('can:delete,checkList');

	Route::put('checkLists/{checkList}', 'CheckListController@update')
		->name('checkLists.update')
		->middleware('can:update,checkList');

	Route::get('checkLists/{checkList}/edit', 'CheckListController@edit')
		->name('checkLists.edit')
		->middleware('can:update,checkList');
	//
	//END - Route CheckListController
	//
});