<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::resource('/checklist', 'CheckListController', [
//    'except' => ['edit', 'show', 'store']
//]);
//Route::resource('checklist', 'CheckListController');
Route::get('homeStatusToMe','StatusController@homeStatusToMe');
Route::post('addStatusToBox','StatusController@addStatusToBox');
Route::get('statusListBox','StatusController@statusListBox');
Route::post('statusUpdateBox/{id}','StatusController@statusUpdate');
Route::get('userStatusCommentsCount','StatusController@userStatusCommentsCount');
Route::get('userStatusCommentsToUserCount','StatusController@userStatusCommentsToUserCount');
Route::get('userTasksCount','StatusController@userTasksCount');
Route::get('userTasksSelf','StatusController@userTasksSelf');
//Route::resource('/apiStatus', 'StatusController');

