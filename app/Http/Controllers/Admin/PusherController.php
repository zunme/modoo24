<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use App\Models\AdminPusher;
use App\Models\AuctionStaff;
use App\Models\AuctionStaffAppId;

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
     $token = AdminPusher::create([
       'admin_id'=>$userinfo['id'],
       'token'=>$request->token
     ]);
   }else if( $token->admin_id != $userinfo['id']) {
     $token->admin_id = $userinfo['id'];
     $token->save();
   }
   return $this->success($token);
  }
  public function sendmsg(){
    $title = "test1234";
    $body = "body test";

    $optionBuilder = new OptionsBuilder();
    $optionBuilder->setTimeToLive(60*20);

    $notificationBuilder = new PayloadNotificationBuilder($title);
    $notificationBuilder->setBody($body)
      ->setIcon('http://modoo24.net/modoo24.ico')
      ->setClickAction('https://24auction.co.kr/community/rhksfl/jisik')
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
  public function getStatus(Request $request){
    $token = null;
    $staff = $this->userinfo();
    if( $request->token){
      $tokenres = AdminPusher::select('id','is_use')->where(['admin_id'=>$staff['id'], 'token'=>$request->token])->first();
      $tokenres->is_use=='Y' ? true:false;
      $token = ['id'=>$tokenres->id, 'is_use'=>$tokenres->is_use=='Y' ? true:false];
    }
    return $this->success(['statusdata'=>$token]);
  }
  public function changeStatus(Request $request){
    $staff = $this->userinfo();
    $token = AdminPusher::where(['id'=>$request->id])->first();
    if( $token->admin_id != $staff['id']){
      return $this->error('권한이 없습니다');
    }
    $token->is_use = $request->is_use;
    $token->save();
    return $this->success(['statusdata'=>$token]);
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

  public function pushcheck(Request $request){

    $idarr = $request->ids;
    $title = $request->title ? $request->title:'푸쉬테스트입니다.';
    $content = $request->content ? $request->content:'푸쉬테스트입니다.['.Carbon::now()->format('Y-m-d H:i:s').']';

    if( $idarr == 'test') {
      $idarr = ['0000','0001','0002','0003','0004','0005','0006','0007','0008','0009','0010','0011','0012'];
    }
    else if (count( $idarr ) < 1 ) return $this->error('ID를 선택해주세요');

    $data = AuctionStaff::
        select('s_uid','s_id')
        ->whereIn( 's_id', $idarr )->get();
    if( empty($data)) return $this->error('ID를 찾을 수 없습니다.');

    foreach(  $data as $row ) $ids[] = $row->s_uid;

    $idstr = implode(',', $ids) ;

		$idsquery = "SELECT distinct(app_push_id), s_uid FROM
    					(
    					SELECT s_uid, app_push_id FROM auction_staff WHERE s_uid IN (". $idstr . ")
    					 UNION
    					SELECT s_uid, app_push_id FROM auction_staff_app_push_ids WHERE s_uid IN (" . $idstr . ")
    					) A";
		$datas =  \DB::select( $idsquery);

    $appids = $staffids = [];
    foreach( $datas as $row) {
      $appids[] = $row->app_push_id;
      $staffids[$row->app_push_id] = $row->s_uid;
    }
    //$res='{"id":"a76c7a2d-f638-4a3e-8d4c-284cf7a181dc","recipients":3,"external_id":null,"errors":{"invalid_player_ids":["0e253ed6-b9fd-42f3-b4ac-e85f61ace742","aa2b01f4-953d-11ec-a080-3e08513c54b0"]},"warnings":["Apple iOS Errors: (Invalid Push Certificate) Apple returned a BadCertificate error. Your certificate was rejected by Apple and may be expired, revoked, or invalid."]}';

    $res = $this->sendOneSignal($appids, $title, $content);

    $resClass = json_decode($res);
    if( count($resClass->errors->invalid_player_ids) > 0 ){
      foreach( $resClass->errors->invalid_player_ids as $pids ){
        try{
          $d = AuctionStaffAppId::where (['s_uid'=> $staffids[$pids], 'app_push_id'=>$pids])->delete()->save();
        }catch (\Exception $e){
          ;
        }
      }
    }

    return $this->success(['res'=>json_decode($res),'ids'=>$staffids, 'datas'=>$datas ]);
  }
}
