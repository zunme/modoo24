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
//고객 평가 등급
Route::get('/evaluationGrade','Api\DefaultlistController@evaluationGrade');
//소통평가등급
Route::get('/communityGrade','Api\DefaultlistController@communityGrade');
//n개월 공감수
Route::get('/bestRangeCount','Api\DefaultlistController@bestRangeCount');

Route::get('/jisikList','Front\BulletinController@jisikListApi');


Route::get('/son','Api\DefaultlistController@sonList');
Route::get('/gugun','Api\DefaultlistController@gugun');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
