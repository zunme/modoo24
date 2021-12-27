<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use App\Models\AdminPusher;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class PusherController extends Controller
{
  use ApiResponser;
  function store(Request $request){
    $userinfo = $this->userinfo();
    if( !$userinfo) return $this->error("로그인후 사용해주세요", 401);
   $this->validate($request, [
     'token' => 'required|string',
   ]);
   $token = AdminPusher::where( ['token'=>$request->token ])->first();
   if(!$token) {
     AdminPusher::create([
       'admin_id'=>$userinfo['id'],
       'token'=>$request->token
     ]);
   }else if( $token->admin_id != $userinfo['id']) {
     $token->admin_id = $userinfo['id'];
     $token->save();
   }
   return $this->success();
  }
  public function sendmsg(){
    $title = "test1234";
    $body = "body test";

    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder($title);
    $notificationBuilder->setBody($body)
    				    ->setSound('default');
    $dataBuilder = new PayloadDataBuilder();
    $dataBuilder->addData(['a_data' => 'my_data']);

    $option = $optionBuilder->build();
    $notification = $notificationBuilder->build();
    $data = $dataBuilder->build();

    $tokens = AdminPusher::where(['is_use'=>'Y'])->pluck('token')->toArray();

    $downstreamResponse = FCM::sendTo($tokens, $option, $notification, $data);
    /*
  dump( $tokens );
    dump($downstreamResponse->numberSuccess());
    dump($downstreamResponse->numberFailure());
    dump($downstreamResponse->numberModification());

        // return Array - you must remove all this tokens in your database
    dump($downstreamResponse->tokensToDelete());

    // return Array (key : oldToken, value : new token - you must change the token in your database)
    dump($downstreamResponse->tokensToModify());

    // return Array - you should try to resend the message to the tokens in the array
    dump($downstreamResponse->tokensToRetry());

    // return Array (key:token, value:error) - in production you should remove from your database the tokens present in this array
  dump(  $downstreamResponse->tokensWithError());
  */
  }
  private function userinfo(){
    session_start();
    $session =  $_SESSION;
    session_write_close();
    if( !isset ( $session['ad_idx'] ) ) return false;
    else return [
      'id'=>$session['ad_idx'],
      'level'=>$session['ad_level'],
      'name'=>$session['ad_name']
    ];
  }
}
