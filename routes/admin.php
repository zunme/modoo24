<?php
Route::group([
    'as' => 'rhksfl.',
    'middleware' => ['level:admin'],
], function () {
    Route::get('home', 'HomeController@index')->name('home');
	
		//게시판
		Route::group(['prefix' => 'bulletin',], function() {
			Route::get('list/{code}', 'BulletinController@bulletinList' );
			Route::get('commentConfirm/{code}', 'BulletinController@commentConfirmList' );
			Route::get('post/{post_id}', 'BulletinController@post' );

			Route::post('post/changestatus', 'BulletinController@changePostStatus' );

			Route::post('comment/deny/{comment_id}', 'BulletinController@denyComment' );
			Route::post('comment/confirm/{comment_id}', 'BulletinController@allowComment' );
			
			// 댓글 갯수, best, fav 카운팅
			Route::get('resetlog', 'BulletinController@resetlog' );
		});

		
		//유저
		Route::group(['prefix' => 'user',], function() {
			Route::get('info', 'UserController@userInfo');
			Route::get('list', 'UserController@usersList');
			
			Route::get('staffInfo', 'UserController@staffInfo');
		});
			// STAFF
		Route::group(['prefix' => 'staff',], function() {
			Route::get('info', 'StaffController@staffInfo');
		});
	
    Route::group([
        'prefix' => 'setting',
    ], function () {
        Route::resource('board-infos', BoardController::class);
    });
});	
?>