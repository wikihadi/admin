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
Route::get('jobs/taskIsDone','TaskOrderUserController@taskIsDone');
Route::get('fetchPosts','PostController@fetchPosts');
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
Route::get('checkFin','FinController@checkFin');
Route::get('delFin','FinController@delFin');
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
Route::get('fetchGallery','GalleryController@fetchGallery');
Route::get('delGallery','GalleryController@delGallery');
Route::get('starGallery','GalleryController@starGallery');
Route::get('fetchMyTasksLastComments','StatusController@fetchMyTasksLastComments');

Route::post('finFormSubmit','ServiceController@finFormSubmit');
Route::post('formSubmit','ServiceController@formSubmit');
Route::get('updateFin','FinController@updateFin');
Route::get('deleteStatus','StatusController@deleteStatus');

//Chatbox
Route::get('fetchUsersChatbox','StatusController@fetchUsersChatbox');
Route::get('fetchUserChatbox','StatusController@fetchUserChatbox');
Route::post('chatboxFrmConfirm','StatusController@chatboxFrmConfirm');

//Reseller
Route::get('resellerFetchTasks','ResellerController@resellerFetchTasks');

//task-admin
Route::get('taskAdminAPI','StatusController@taskAdminAPI');
Route::get('taskEndAdminAPI','StatusController@taskEndAdminAPI');
Route::get('taskAccAdminAPI','StatusController@taskAccAdminAPI');
Route::get('costSum','StatusController@costSum');

//Press
Route::post('addPress','PressController@addPress');
Route::get('fetchPress','PressController@fetchPress');
Route::get('pressDel','PressController@pressDel');
Route::get('addOptionPress','PressController@addOptionPress');
Route::get('fetchOptions','PressController@fetchOptions');


//Dashboard api
Route::get('d/u','DashboardController@u');
Route::get('d/task/all','DashboardController@taskAll');



//Services Apis
//Route::get('addFood','StatusController@add');

//Route::resource('/apiStatus', 'StatusController');

