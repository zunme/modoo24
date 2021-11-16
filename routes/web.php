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

Route::get('/','HomeController@home');

Route::get('/test', 'HomeController@test');
Route::get('/altest', 'HomeController@altest');

Route::get('/refresh', 'HomeController@refresh');
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/login/{provider}', 'SocialController@redirect');
Route::get('/login/{provider}/callback', 'SocialController@Callback');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/find/password', 'Auth\FindController@password');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@password')->middleware('guest')->name('password.email');
//이메일컨펌
Route::get('users/{user}/{token}/confirm', 'Auth\\RegisterController@confirm')->name('confirm');

//게시판
Route::prefix('/posts')->name('posts.')->group(function () {

	Route::get('{code}', 'Front\BulletinController@contentList');
	Route::get('{code}/listapi', 'Front\BulletinController@contentListApi');

	Route::get('{code}/view/{viewid}', 'Front\BulletinController@view');
  //글 공감
  Route::post('{code}/favorite/{post_id}', 'Front\BulletinController@postFavorite');

  //2차 COMMENT
  Route::post('commentv2','Front\BulletinController@commentV2');
  Route::post('commentv2/del','Front\BulletinController@commentV2Del');
  Route::get('commentv2/info','Front\BulletinController@commentV2Info');

  Route::get('{code}/comment/view/{post_id}','Front\BulletinController@commentV2view');
  Route::post('recomment','Front\BulletinController@recomment');
  Route::post('commentupdate','Front\BulletinController@commentupdate');

	Route::middleware('auth:web')->group(function () {
		Route::get('{code}/write', 'Front\BulletinController@writeForm');
		Route::get('{code}/update/{writeid}', 'Front\BulletinController@updateForm');

		Route::post('create', 'Front\BulletinController@create');

		//Route::post('{code}/update', 'Front\BulletinController@update');
		//Route::post('{code}/delete', 'Front\BulletinController@delete');
		Route::post('del','Front\BulletinController@delPrc');
	});

	//TODO comment 달수있는 사람은??? 회원 or 파트너 ??
	Route::post('{code}/comment/write/{writeid}', 'Front\BulletinController@commentWrite');
	Route::post('comment/create', 'Front\BulletinController@commentCreate');
  Route::post('comment/update', 'Front\BulletinController@jisikCommentUpdate');
  Route::post('comment/delete', 'Front\BulletinController@jisikCommentDelete');

  // fav & best 통합으로 인해 변경함
	//Route::post('comment/addfavcnt', 'Front\BulletinController@addfavcnt');
	//Route::post('comment/addbestcnt', 'Front\BulletinController@addbestcnt');

  // 댓글 fav & best 통합버전
  Route::post('comment/addbestcntV2', 'Front\BulletinController@addbestcntv2');


});

//신청내역
Route::get('/my/request', 'Front\MyController@requestList');
Route::post('/my/sendsms', 'Front\MyController@sendsms');
Route::post('/my/checkAuth', 'Front\MyController@checkAuth');

//이벤트
Route::get('/event', 'Front\EventController@index');
Route::get('/event/{code}', 'Front\EventController@viewdetail');

Route::post('/wngur/fakelog', 'Front\MyController@fakelog');

Auth::routes();
Route::get('/home', function () {
    return redirect('/posts/jisik');
})->name('home');

Route::middleware('auth:web')->prefix('/member')->name('member.')->group(function () {
  Route::get('myinfo', 'Front\UserController@myinfo');

  Route::get('modify', 'Front\UserController@modify');
  Route::post('modify', 'Front\UserController@modifyPrc');
  Route::post('modify-sub', 'Front\UserController@modifySubPrc');

  //인증번호 발송
  Route::post('sendsms', 'Front\UserController@sendsms');
  Route::post('modify/tel', 'Front\UserController@modifyTel');

  //탈퇴
  Route::get('withdrawal', 'Front\UserController@withdrawal');
  Route::post('withdrawal', 'Front\UserController@withdrawalPrc');

});
