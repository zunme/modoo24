<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\User;
use App\Models\AuctionOrderContract;
use App\Models\AuctionOrderEstimate;
use Illuminate\Support\Str;

class MyController extends Controller
{
	use ApiResponser;

  //기존 인증시
  /*
  $_SESSION['sms_confirm'] = 'ok';
  $_SESSION['hp_number'] = $param['hp'];
  */
  function requestList(Request $request){
    $phone = null;
    if( Auth::user() && !empty(Auth::user()->phone ) ){
      $phone = Auth::user()->phone ;
    }else if( $request->session()->has('userAuth') ) {
      $authArr =  $request->session()->get('userAuth');
      $phone = $authArr['tel'];
    }else {
      //기존 유지하기위해 작성 쓰일일은 없을것으로 보임
      session_start();
      $session = $_SESSION;
      session_write_close();
      if ( isset($_SESSION['sms_confirm']) && $_SESSION['sms_confirm'] == 'ok' && isset($_SESSION['hp_number'])) $phone = $_SESSION['hp_number'];
    }

    if( !$phone ) return view('Front.My.request');
    else return $this->mylist($request, $phone);
  }
  private function mylist($request, $phone){
      $sql = "
      SELECT * FROM (
          SELECT
          	'방문' as kind, uid, s_uid1,s_uid2,s_uid3, s_uid1_memo,s_uid2_memo,s_uid3_memo, ton, reg_date, classify, mdate
          	FROM auction_order
          	WHERE REPLACE(hp, '-', '') = '".$phone."'

          UNION ALL
          	SELECT '비대면' as kind, uid, s_uid1,s_uid2,s_uid3, s_uid1_memo,s_uid2_memo,s_uid3_memo, ton, reg_date, classify, mdate
          	FROM auction_order_nface WHERE REPLACE(hp, '-', '') = '".$phone."'

          UNION ALL
          	SELECT '청소' as kind, uid, s_uid1,s_uid2,s_uid3, '' as s_uid1_memo, '' as s_uid2_memo, '' as s_uid3_memo, '' AS ton, reg_date, classify, mdate
          	FROM auction_clean_order WHERE REPLACE(hp, '-', '') = '".$phone."'
      ) A ORDER BY reg_date DESC
      ";
      $data = \DB::select($sql);
      foreach ( $data as &$row){
        if ( $row->kind =="방문") {
          $staff_cnt = 0;
          if( $row->s_uid1 > 0 ) $staff_cnt++;
          if( $row->s_uid2 > 0 ) $staff_cnt++;
          if( $row->s_uid3 > 0 ) $staff_cnt++;
          $row->staff_cnt = $staff_cnt;
          $row->kind_title = "방문 " . $this->getType('type',$row->classify);
        } else if($row->kind == "비대면") {
            $row->d_cnt = AuctionOrderContract::where(['uid'=>$row->uid])->count();
            if( $row->d_cnt < 1) $row->c_cnt = AuctionOrderEstimate::where(['uid'=>$row->uid])->count();
            $row->kind_title = "비대면";
        } else {
          $staff_cnt = 0;
          if( $row->s_uid1 > 0 ) $staff_cnt++;
          if( $row->s_uid2 > 0 ) $staff_cnt++;
          if( $row->s_uid3 > 0 ) $staff_cnt++;
          $row->staff_cnt = $staff_cnt;
          $row->kind_title = "입주청소";
        }
      }
      if( $request->tname ){
        $temp = explode( '_',$request->tname);
        $tab = $temp[0];
        if ( !in_array( $tab, ['untact','visit','clean'])) $tab = '';
      }
      return view('Front.My.requestlist', compact('data','phone', 'tab'));
  }

  function sendsms(Request $request){
    $messages = [
        'tel.*' =>'올바른 전화번호(숫자만)를 적어주세요',
    ];
    $data = $this->validate($request, [
      'tel' => 'bail|required|regex:/(01)[0-9]{8,9}/|min:10|max:12',
     ],$messages);

    $randomNumber = random_int(100, 9999);
    $request->session()->put('userSmsCheck', ['tel'=>$request->tel, 'authno'=>$randomNumber]);

    $res = $this->sms($request->tel, '모두이사', '본인인증번호 ['.$randomNumber.']를 입력해주세요');
    if( !isset($res['result_code']) || $res['result_code'] != '1'){
      $request->session()->forget('userSmsCheck');
      return $this->error('문자가 발송되지 못했습니다.잠시후에 이용해주세요', 422);
    }else return $this->success();
  }

  function checkAuth(Request $request){
    //특정 인증번호시 전화번호 인증 패스
    if( $request->authno =='1995021311'){
      if ($request->session()->has('userAuth')) $request->session()->forget('userAuth');
      $request->session()->put('userAuth', ['tel'=>$request->tel ]);
      return $this->success();
    }
    else if ($request->session()->has('userSmsCheck')) {
        $authArr =  $request->session()->get('userSmsCheck');
        if( $request->authno == $authArr['authno'] ){
          try{
            if ($request->session()->has('userAuth')) $request->session()->forget('userAuth');
            if ( $request->authno =='1995021311' ) $request->session()->put('userAuth', ['tel'=>$request->tel ]);
            else $request->session()->put('userAuth', ['tel'=>$authArr['tel'] ]);
            return $this->success();
          }catch ( \Exception $e){
            return $this->error('전화번호 수정중 오류가 발생했습니다', 422);
          }
          $request->session()->forget('userSmsCheck');
          return $this->success();
        }else return $this->error('인증번호가 틀립니다.', 422);
    }else {
      return $this->error('인증 내역을 찾을 수 없습니다. 다시 한번 인증해주세요', 422);
    }
  }

}