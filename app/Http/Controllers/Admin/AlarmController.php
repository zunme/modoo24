<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use App\Models\Alarm;
use App\Models\AlarmMember;
use App\Models\AuctionMember;

use App\Events\AlarmEvent;

class AlarmController extends Controller
{
  use ApiResponser;
  function alarmform(Request $request){
    $userinfo = $this->userinfo();
    if( !$userinfo) return $this->error("로그인후 사용해주세요", 401);
    $members = AuctionMember::where(['am_use_flag'=>'Y'])->orderBy('am_name')->get();
    $now = Carbon::now();
    $hh = $now->format('H');
    $mm = $now->format('i');
    $req = $request->all();
    return view('admin.alarmform', compact(['members','userinfo','now', 'hh','mm','req']));
  }
  function alarmlist(Request $request){
    $userinfo = $this->userinfo();
    if( !$userinfo) return $this->error("로그인후 사용해주세요", 401);
    $data = Alarm::select( 'auction_alram.*')
      ->join( 'auction_alram_member', 'auction_alram.aa_idx','=','auction_alram_member.aam_aa_idx')
      ->where('aa_alram_date','>', \DB::raw('DATE_SUB( NOW(), INTERVAL 12 hour)') )
      ->where([
        'auction_alram_member.aam_flag'=> 'N',
        'aam_mem_idx'=> $userinfo['id']
      ])
      ->orderby( 'aa_alram_date', 'desc')
      //->limit(1)
      ->get();
      return $this->success( ['data'=>$data, 'userid'=>$userinfo['id']] );
  }
  function alarmCreate(Request $request){
    $userinfo = $this->userinfo();
    if( !$userinfo) return $this->error("로그인후 사용해주세요", 401);

    $messages = [
        'aa_alram_date1.*' => '알람(날짜)를 선택해주세요.',
        'aa_alram_date2.*' =>'알람(시간)을 선택해주세요',
        'aa_alram_date3.*' =>'알람(분)을 선택해주세요',
        'aa_send_mem.*' =>'알람받을 사람을 선택해주세요',
        'aa_memo.*' =>'알람 내용을 입력해주세요',
        'order_idx' =>'입력된 오더번호가 없습니다.'
    ];
    $this->validate($request, [
      'aa_alram_date1'=>'bail|required|date_format:Y-m-d',
      'aa_alram_date2'=>'bail|required|numeric',
      'aa_alram_date3'=>'bail|required|numeric',
      'aa_send_mem' => 'bail|required',
      'aa_send_mem.*' => 'bail|numeric',
      'aa_memo'=>'bail|required|string',
      'alarm_type'=>'bail|required|in:order,nface,clean,normal',
      'order_idx'=>'bail|nullable|numeric',
    ],$messages);

    $data = [
      'aa_reg_idx'=>$userinfo['id'],
      'aa_order_idx'=>$request->order_idx > 0 ? $request->order_idx:'0',
      'aa_alram_date'=>$request->aa_alram_date1.' '.$request->aa_alram_date2.':'.$request->aa_alram_date3.':00',
      'aa_memo'=>$request->aa_memo
    ];
    if ( !$request->order_idx ) $data['order_idx'] = '0';
    if( $request->alarm_type == 'order') $data['aa_memo'] = '[이사오더 : '.$data['aa_order_idx'].']'.PHP_EOL.$data['aa_memo'];
    else if( $request->alarm_type == 'nface') $data['aa_memo'] = '[비대면오더 : '.$data['aa_order_idx'].']'.PHP_EOL.$data['aa_memo'];
    else if( $request->alarm_type == 'clean') $data['aa_memo'] = '[청소오더 : '.$data['aa_order_idx'].']'.PHP_EOL.$data['aa_memo'];

    \DB::beginTransaction();
    try{
      $alarm = Alarm::create( $data );
      foreach ( $request->aa_send_mem as $val){
        AlarmMember::create(['aam_aa_idx'=>$alarm->aa_idx, 'aam_mem_idx'=>$val, 'aam_flag'=>'N' ]);
      }
      \DB::commit();
    }catch ( \Exception $e){
      \DB::rollback();
			return $this->error('잠시 후에 이용해주세요.', 422, $e->getMessage() );
    }
    $eventalarm = Alarm::with(['members'])->where(['aa_idx'=>$alarm->aa_idx])->first();
    event(new AlarmEvent( $eventalarm ));
    return $this->success();
  }
  function alarmDone(Request $request){
/*
test
    $alarm = Alarm::with(['members'])->where(['aa_idx'=>$request->aa_idx])->first();
    event(new AlarmEvent( $alarm ));
    return $this->success( $alarm );
*/
    $userinfo = $this->userinfo();
    if( !$userinfo) return $this->error("로그인후 사용해주세요", 401);
    $alarm = AlarmMember::where(['aam_aa_idx'=>$request->aa_idx, 'aam_mem_idx'=>$userinfo['id'] ])->first();
    if( !$alarm) return $this->error("알람을 찾을 수 없습니다.", 422);
    $alarm->aam_flag = 'Y';
    $alarm->save();
    return $this->success( );
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
