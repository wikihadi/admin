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
    Route::get('noRoles', 'HomeController@noRoles')->name('noRoles');
    Route::group(['middleware' => ['noRules']], function () {

        Route::resource('status', 'StatusController');
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('/home', function () {
            return redirect('/');
        });

//    Route::get('/',function (){
//        $user = Auth::user();
//       event(new \App\Events\ArticleEvent($user));
//       return 'Done';
//    });

        Route::group(['middleware' => ['offUser']], function () {
            Route::post('verify/{post}', 'PostController@verifyPost');
    //        Route::resource('media', 'MediaController');
            Route::resource('posts', 'PostController');


            Route::get('/profile', 'ProfileController@profile');
            Route::post('/profile', 'ProfileController@update_avatar');

            Route::resource('tasks', 'TaskController');


            Route::group(['middleware' => ['role:modir|admin']], function () {

                Route::get('finance-check', 'TaskController@finance1');


                Route::get('statics', 'StatusController@statics');
                Route::get('/jobs', 'TaskController@modir');
                Route::put('/jobs/updateAll','TaskOrderUserController@updateAll')->name('tasks.updateAll');
                Route::get('/jobs/updateRoutine/{id}','TaskOrderUserController@updateRoutine')->name('tasks.updateRoutine');
                Route::get('/jobs/{id}', 'TaskController@modirUser');
                Route::resource('taskorderusers', 'TaskOrderUserController');
                Route::get('/pending', 'TaskController@pending');
                Route::get('/pending/{id}', 'TaskController@pendingUser');
                Route::resource('categories', 'CategoryController');
                Route::resource('brands', 'BrandController');
                Route::get('/materials', 'CategoryController@materials');
                Route::get('/dimensions', 'CategoryController@dimensions');
                Route::get('/types', 'CategoryController@types');
                Route::get('/done', 'TaskController@isDone');
                Route::get('/done/{id}', 'TaskController@userIsDone');
                Route::resource('roles','RoleController');
                Route::resource('users','UserController');
            });
            Route::group(['middleware' => ['role:finance|admin']], function () {
                Route::get('finance-final', 'TaskController@finance2');
                Route::get('taskPayForm','TaskController@taskPayForm');

            });


            Route::group(['middleware' => ['role:admin|modir']], function () {

                Route::get('admin/tasks', 'TaskController@adminIndex');
                Route::get('finance', 'TaskController@finance');
                Route::post('/financeUpdate/{id}', 'TaskController@financeUpdate')->name('tasks.financeUpdate');


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
    });
});









