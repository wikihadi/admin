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

    Route::resource('posts', 'PostController');
    Route::post('verify/{post}', 'PostController@verifyPost');

    Route::resource('status', 'StatusController');
    Route::resource('tasks', 'TaskController');
    Route::resource('media', 'MediaController');
    Route::resource('comments', 'CommentController');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', function () {
        return redirect('/');
    });
    Route::get('/profile', 'ProfileController@profile');
    Route::post('/profile', 'ProfileController@update_avatar');

    Route::get('/tasks/{id}/start', 'TaskMeterController@start');
    Route::get('/tasks/{id}/end', 'TaskMeterController@end');

//    Route::post('/tasks/up', 'TaskMeterController@upOrder')->name('tasks.up');
    Route::resource('taskorderusers', 'TaskOrderUserController');
   // Route::post('taskorderusersup', array('as' => 'up', 'uses' => 'TaskOrderUserController@up'))->name('taskorderuser.up');
//    Route::post('taskorderusersup',['uses'=>'TaskOrderUserController@up']);


    Route::get('/pending', 'TaskController@pending');
    Route::get('/pending/{id}', 'TaskController@pendingUser');



    Route::post('/tasks/{task}', 'TaskController@done')->name('tasks.done');
    //Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::resource('categories', 'CategoryController');
    Route::resource('brands', 'BrandController');
    Route::get('/materials', 'CategoryController@materials');
    Route::get('/dimensions', 'CategoryController@dimensions');
    Route::get('/types', 'CategoryController@types');
    Route::get('/all-tasks', 'TaskController@allTasks');
    Route::get('/task-meters', 'TaskController@taskMeters');

    Route::group(['middleware' => ['role:modir|admin']], function () {

        Route::get('/jobs', 'TaskController@modir');

        Route::put('/jobs/updateAll','TaskOrderUserController@updateAll')->name('tasks.updateAll');

        Route::get('/jobs/{id}', 'TaskController@modirUser');
    });


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









