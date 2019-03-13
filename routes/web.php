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

Route::group(['middleware' => ['auth']], function() {

    Route::resource('tasks', 'TaskController');
    Route::resource('comments', 'CommentController');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', function () {
        return redirect('/');
    });
    Route::get('/profile', 'UserController@profile');
    Route::post('/profile', 'UserController@update_avatar');
    //Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::resource('categories', 'CategoryController');
    Route::resource('brands', 'BrandController');

    Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('roles','RoleController');
        Route::resource('users','UserController');

    });


});









