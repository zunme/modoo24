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
Route::post('/simpyreg','Api\OrdertempController@simplyreg');
Route::get('/movereview','Api\DefaultlistController@reviewMain');
Route::get('/makeinc','Api\DefaultlistController@makeinc');


Route::get('/son','Api\DefaultlistController@sonList');
Route::get('/gugun','Api\DefaultlistController@gugun');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
