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
Route::get('/front/main',function(){
  return redirect('/');
});

Route::get('/testhome','HomeController@testhome');

Route::get('/test', 'HomeController@test');
Route::get('/altest', 'HomeController@altest');

Route::get('/refresh', 'HomeController@refresh');
Route::get('/welcome', function () {
    return view('welcome');
});

//인터넷정보제공동의리스트
Route::get('/dlsxjlist','External\InternetController@index');
Route::post('/dlsxjlist','External\InternetController@index');

Route :: get('/tracelog/{code}/{step}', 'Front\NfaceorderController@makelog');
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
Route::get('/my/request/{code}', 'Front\MyController@requestCode');
Route::post('/my/sendsms', 'Front\MyController@sendsms');
Route::post('/my/checkAuth', 'Front\MyController@checkAuth');
Route::post('/my/checkAuthWithName', 'Front\MyController@checkAuthWithName');

//이사후기
Route::prefix('/review')->name('review.')->group(function () {
    Route::get('/', 'Front\ReviewController@index');
    Route::get('/my', 'Front\ReviewController@myReview');
    Route::get('/my/list', 'Front\ReviewController@myReviewList');
    Route::get('/my/list/api', 'Front\ReviewController@myReviewListApi');
    Route::get('/my/companylist', 'Front\ReviewController@companylist');
    Route::get('/write/{type}/{uid}/{s_uid}', 'Front\ReviewController@myReviewWrite');
    Route::post('/write/{type}', 'Front\ReviewController@reviewWritePrc');

});

//비대면견적신청
  Route::prefix('/order/nface')->name('nface.')->group(function () {
    Route::post('/step1', 'Front\NfaceorderController@step1');
    Route::post('/step2', 'Front\NfaceorderController@step2');
    Route::post('/step3', 'Front\NfaceorderController@step3');
    Route::post('/step4', 'Front\NfaceorderController@step4');

    Route::post('/complete', 'Front\NfaceorderController@complete');
  });

// AI
  Route::prefix('/order/ai')->name('ai.')->group(function () {
    Route::post('/', 'Front\AiController@index');
  });

//방문견적
Route::prefix('/order/contact')->name('contact.')->group(function () {
  Route::post('/step1', 'Front\ContactorderController@step1');
  Route::post('/step2', 'Front\ContactorderController@step2');
  Route::post('/step3', 'Front\ContactorderController@step3');
  Route::post('/step4', 'Front\ContactorderController@step4');
  Route::post('/step5', 'Front\ContactorderController@step5');

  Route::post('/complete', 'Front\NfaceorderController@complete');
});



//이벤트
Route::get('/event', 'Front\EventController@index');
Route::get('/event/{code}', 'Front\EventController@viewdetail');
Route::get('/event/view/{id}', 'Front\EventController@viewevent');
Route::get('/event/link/{id}', 'Front\EventController@linkcount');

Route::post('/wngur/fakelog', 'Front\MyController@fakelog');

Auth::routes();
Route::get('/home', function () {
    return redirect('/posts/jisik');
})->name('home');

// 파트너 페이지
Route::prefix('/partner')->name('partner.')->group(function () {
 Route::get('/', 'Partner\PartnerController@index');
 Route::post('/modify/{id}', 'Partner\PartnerController@modifyPrc');
  Route::get('/info/{id}', 'Partner\NewnfaceorderController@getInfo');
});

Route::prefix('/mob')->name('frame.')->group(function () {
  Route::get('/', 'Front\FrameController@index');
  Route::get('/{path1}', 'Front\FrameController@index');
  Route::get('/{path1}/{path2}', 'Front\FrameController@index');
  Route::get('/{path1}/{path2}/{path3}', 'Front\FrameController@index');
  Route::get('/{path1}/{path2}/{path3}/{path4}', 'Front\FrameController@index');
  Route::get('/{path1}/{path2}/{path3}/{path4}/{path5}', 'Front\FrameController@index');
});
Route::prefix('/pages')->group(function () {
  Route::get('/home', 'Front\FrameController@home');
  Route::get('/review/{id}', 'Front\FrameController@review');
  Route::get('/board/view/{code}/{id}', 'Front\FrameController@viewboard');
  Route::get('/posts/{code}', 'Front\FrameController@postsList');
  Route::get('/checkphone', 'Front\FrameController@checkSession');
  Route::get('/myrequest', 'Front\FrameController@myRequestList');
});


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
