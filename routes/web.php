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



//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/', 'ItemController@index');
Route::get('/items/', 'ItemController@index')
    ->name('list_items');
Route::group(['middleware' => ['auth'], 'prefix' => 'item'], function () {
    Route::get('/new', 'ItemController@create')
        ->name('create_item')
        ->middleware('can:create');
    Route::post('/new', 'ItemController@store')
        ->name('store_item')
        ->middleware('can:create');
    Route::post('/{item}/done', 'ItemController@done')
        ->name('item_done')
        ->middleware('can:accessItem,item');
    Route::post('/{item}/undone', 'ItemController@undone')
        ->name('item_undone')
        ->middleware('can:accessItem,item');
    Route::get('/edit/{item}', 'ItemController@edit')
        ->name('edit_item')
        ->middleware('can:accessItem,item');
    Route::post('/update/{item}', 'ItemController@update')
        ->name('update_item')
        ->middleware('can:accessItem,item');
    Route::post('/delete/{item}', 'ItemController@destroy')
        ->name('delete_item')
        ->middleware('can:accessItem,item');

    // sorting
    Route::match(['get', 'post'], '/date/asc', 'ItemController@sort')
    ->name('sort_items');
});

Route::get('/admin', 'AdminController@index')
    ->name('admin_dashboard')
    ->middleware('isAdmin');

Route::group(['middleware' => ['auth', 'isAdmin'], 'prefix' => 'admin'], function () {
    Route::get('/users', 'AdminController@users')
        ->name('admin_users');

    Route::get('/user/{id}/tasks', 'AdminController@showTasks')
        ->name('all_tasks');
});
