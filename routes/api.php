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
Route::post('updateCost/{id}','StatusController@updateCost');
Route::get('userStatusCommentsCount','StatusController@userStatusCommentsCount');
Route::get('userStatusCommentsToUserCount','StatusController@userStatusCommentsToUserCount');
Route::get('userTasksCount','StatusController@userTasksCount');
Route::get('userTasksSelf','StatusController@userTasksSelf');
Route::get('userPostVerified','StatusController@userPostVerified');
Route::get('userOffCount','StatusController@userOffCount');
Route::get('userBoxCount','StatusController@userBoxCount');
Route::get('userLunchCount','StatusController@userLunchCount');
Route::get('userDaysCount','StatusController@userDaysCount');
Route::get('commentList','StatusController@commentList');
Route::get('allStatics','StatusController@allStatics');
Route::get('allStaticsBoxes','StatusController@allStaticsBoxes');

//Route::resource('/apiStatus', 'StatusController');

