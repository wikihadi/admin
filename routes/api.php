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
Route::put('statusUpdateBox/{id}','StatusController@statusUpdate');
Route::resource('/apiStatus', 'StatusController');

