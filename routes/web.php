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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/refresh', 'HomeController@refresh');
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/login/{provider}', 'SocialController@redirect');
Route::get('/login/{provider}/callback', 'SocialController@Callback');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/find/password', 'Auth\FindController@password');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@password')->middleware('guest')->name('password.email');

//게시판
Route::prefix('/posts')->name('posts.')->group(function () {

	Route::get('{code}', 'Front\BulletinController@contentList');
	Route::get('{code}/listapi', 'Front\BulletinController@contentListApi');

	Route::get('{code}/view/{viewid}', 'Front\BulletinController@view');

	Route::middleware('auth:web')->group(function () {
		Route::get('{code}/write', 'Front\BulletinController@writeForm');
		Route::get('{code}/update/{writeid}', 'Front\BulletinController@updateForm');

		Route::post('create', 'Front\BulletinController@create');

		Route::post('{code}/update', 'Front\BulletinController@update');
		Route::post('{code}/delete', 'Front\BulletinController@delete');
		Route::post('del','Front\BulletinController@delPrc');

	});
	//TODO comment 달수있는 사람은??? 회원 or 파트너 ??
	Route::post('{code}/comment/write/{writeid}', 'Front\BulletinController@commentWrite');
	Route::post('comment/create', 'Front\BulletinController@commentCreate');

  // fav & best 통합으로 인해 변경함
	//Route::post('comment/addfavcnt', 'Front\BulletinController@addfavcnt');
	//Route::post('comment/addbestcnt', 'Front\BulletinController@addbestcnt');

  //fav & best 통합버전
  Route::post('comment/addbestcntV2', 'Front\BulletinController@addbestcntv2');

});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
