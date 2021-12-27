<?php
Route::group([
    'as' => 'rhksfl.',
    'middleware' => ['level:admin'],
], function () {
    //newHOME
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('jisik', 'HomeController@jisik')->name('jisik');


    //고객정보삭제
    Route::post('order/userinfo/del', 'OrderController@deleteUserInfo');
    Route::get('order/userinfo/list', 'OrderController@deleteUserList');

    //알람
    Route::get('alarm/form', 'AlarmController@alarmform');
    Route::get('alarm', 'AlarmController@alarmlist');
    Route::post('alarm', 'AlarmController@alarmDone');
    Route::post('alarm/regist', 'AlarmController@alarmCreate');

		//게시판
		Route::group(['prefix' => 'bulletin',], function() {
			Route::get('list/{code}', 'BulletinController@bulletinList' );
      Route::get('community-list/{code}', 'BulletinController@communtiyList' );
			Route::get('commentConfirm/{code}', 'BulletinController@commentConfirmList' );
      Route::get('commentConfirmdepth/{code}', 'BulletinController@commentConfirmdepthList' );
      Route::get('commentdepthlist', 'BulletinController@commentdepthlist' );

			Route::get('post/{post_id}', 'BulletinController@post' );
      Route::get('postwithdepth/{post_id}', 'BulletinController@postwithdepth' );

			Route::post('post/changestatus', 'BulletinController@changePostStatus' );
      Route::post('post/changeDate', 'BulletinController@changeDate' );


			Route::post('comment/deny/{comment_id}', 'BulletinController@denyComment' );
      Route::post('commentdepth/deny', 'BulletinController@denyCommentdepth' );

			Route::post('comment/confirm/{comment_id}', 'BulletinController@allowComment' );
      Route::post('commentdepth/confirm', 'BulletinController@allowCommentdepth' );

			// 댓글 갯수, best, fav 카운팅
			Route::get('resetlog', 'BulletinController@resetlog' );

      //메인노출
      Route::post('mainpost', 'BulletinController@mainpostchange' );
		});


		//유저
		Route::group(['prefix' => 'user',], function() {

      Route::post('/', 'UserController@userCreate');
      Route::post('/update', 'UserController@userInfoChange');

			Route::get('info', 'UserController@userInfo');
			Route::get('list', 'UserController@usersList');
			Route::get('staffInfo', 'UserController@staffInfo');
		});
			// STAFF
		Route::group(['prefix' => 'staff',], function() {
			Route::get('info', 'StaffController@staffInfo');
      //업체평가통계
      //Route::get('statics', 'StaffController@statics' );
      Route::get('statics', 'StaffController@staticsv2' );
      Route::get('staticsv2', 'StaffController@staticsv2' );
		});
    // review
  Route::group(['prefix' => 'review',], function() {
    Route::get('/', 'ReviewController@index');
    Route::post('del', 'ReviewController@delReview');
  });

  Route::group([
      'prefix' => 'setting',
  ], function () {
      Route::resource('board-infos', BoardController::class);
  });

	Route::group(['prefix' => 'push'], function() {
    Route::post('add', 'PusherController@store');
    Route::get('send', 'PusherController@sendmsg');
    Route::get('status', 'PusherController@getStatus');
    Route::post('status', 'PusherController@changeStatus');
  });
});
?>
