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
Route::get('playTask','StatusController@playTask');
Route::get('dayComments','StatusController@dayComments');
Route::get('firstVisit','StatusController@firstVisit');
Route::get('statusesFetch','StatusController@statusesFetch');
Route::get('fetchChecklist','StatusController@fetchChecklist');
Route::post('addBoxToUsers','StatusController@addBoxToUsers');
Route::get('addFin','StatusController@addFin');
Route::get('allBrands','StatusController@allBrands');
Route::get('allFin','FinController@allFin');
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
Route::get('taskPayForm','TaskController@taskPayForm');
Route::get('searchTasks','StatusController@searchTasks');
Route::get('fetchTasks','StatusController@fetchTasks');
Route::get('commentFetch','StatusController@commentFetch');
Route::get('chartFetch','StatusController@chartFetch');
Route::get('fetchMyTasksLastComments','StatusController@fetchMyTasksLastComments');

//Route::resource('/apiStatus', 'StatusController');

