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
    Route::resource('media', 'MediaController');
    Route::resource('comments', 'CommentController');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', function () {
        return redirect('/');
    });
    Route::get('/profile', 'ProfileController@profile');
    Route::post('/profile', 'ProfileController@update_avatar');
    Route::post('/tasks/{task}', 'TaskController@done')->name('tasks.done');
    //Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::resource('categories', 'CategoryController');
    Route::resource('brands', 'BrandController');
    Route::get('/materials', 'CategoryController@materials');
    Route::get('/dimensions', 'CategoryController@dimensions');
    Route::get('/types', 'CategoryController@types');
    Route::get('/all-tasks', 'TaskController@allTasks');
    Route::get('/done', 'TaskController@isDone');
    Route::get('/done/{id}', 'TaskController@userIsDone');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::group(['middleware' => ['role:admin']], function () {


        Route::get('storage/{filename}', function ($filename)
        {
            $path = storage_path($filename);

            if (!File::exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        });

    });


});









