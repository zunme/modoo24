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
Route::get('/star','Api\DefaultlistController@avgStarReq');

//고객 평가 등급
Route::get('/evaluationGrade','Api\DefaultlistController@evaluationGrade');
//소통평가등급
Route::get('/communityGrade','Api\DefaultlistController@communityGrade');
//n개월 공감수
Route::get('/bestRangeCount','Api\DefaultlistController@bestRangeCount');
//지식인 리스트
Route::get('/jisikList','Front\BulletinController@jisikListApi');

//파트너 전체 파일 & 평점
Route::get('/review/files/{s_uid}','Api\AuctionstaffController@reviewfiles');
Route::get('/review/staff/{s_uid}','Api\AuctionstaffController@staffReviews');
Route::get('/review/staff_d/{s_uid}','Api\AuctionstaffController@staff_data');

Route::post('/review/staffMyReviews','Api\AuctionstaffController@staffMyReviewsWrite');
Route::get('/review/staffMyReviews/{type}','Api\AuctionstaffController@staffMyReviews');


Route::get('/staff/communitygradev2','Api\AuctionstaffController@getStaffCommunityGrade');

//내 비대면 견적 리스트
Route::get('/applicationHistory/nfacelist/{uid}','Api\OrderController@nfacelist');

Route::get('/son','Api\DefaultlistController@sonList');
Route::get('/gugun','Api\DefaultlistController@gugun');


//견적리스트

Route::get('/orderGoods','Api\MoveorderController@goodslist');
Route::post('/ordergoods/add','Api\MoveorderController@addGoods');

Route::post('/pushcheck','Api\PushcheckController@checklist');
Route::post('/pushme','Api\PushcheckController@pushme');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
