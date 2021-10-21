<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
	use ApiResponser;

  function myinfo(Request $request){
    $user = Auth::User();
    return view("/Front/Member/myinfo", compact(["user"]));
  }
  function withdrawal(Request $request){
    $user = Auth::User();
    return view("/Front/Member/withdrawal", compact(["user"]));
  }
  function withdrawalPrc(Request $request){
    $user = Auth::User();

    $messages = [
        'reason.*' => '탈퇴사유를 100자 이내로 적어주세요.',
				'withdrawalcheck.*' => '회원 탈퇴에 대한 내용을 확인해주세요.',
    ];
    $data = $this->validate($request, [
      'reason' => 'bail|required|string|min:2|max:255',
			'withdrawalcheck'=>'bail|required|in:Y',
     ],$messages);
     $reason = trim(strip_tags($request->reason));
     if( $reason == '') $this->error($messages['reason.*'], 422);

    $user = User::where( ['id'=>Auth::user()->id])->first();
    try{
      $user->reasonWithdrawal = strip_tags($request->reason);
      $user->save();
      $user->delete();
      session_start();
      session_destroy();
      return $this->success();
    } catch ( \Exception $e){
      return $this->error('잠시후에 다시 시도해주세요', 422);
    }

  }
  function modify(Request $request){
    $user = Auth::User();
    return view("/Front/Member/modify", compact(["user"]));
  }
  function sendsms(Request $request){
    $messages = [
        'tel.*' =>'올바른 전화번호(숫자만)를 적어주세요',
    ];
    $data = $this->validate($request, [
      'tel' => 'bail|required|regex:/(01)[0-9]{8,9}/|min:10|max:12',
     ],$messages);

    if (!Auth::user()) return $this->error('회원 정보를 찾을  수 없습니다.', 422);

    $randomNumber = random_int(100, 9999);
    $request->session()->put('userSmsCheck', ['tel'=>$request->tel, 'authno'=>$randomNumber]);

    $res = $this->sms($request->tel, '모두이사', '본인인증번호 ['.$randomNumber.']를 입력해주세요');
    if( !isset($res['result_code']) || $res['result_code'] != '1'){
      $request->session()->forget('userSmsCheck');
      return $this->error('문자가 발송되지 못했습니다.잠시후에 이용해주세요', 422);
    }else return $this->success();
  }
  function modifyTel(Request $request){
    $user = Auth::User();
    if (!Auth::user()) return $this->error('회원 정보를 찾을  수 없습니다.', 422);

    if ($request->session()->has('userSmsCheck')) {
        $authArr =  $request->session()->get('userSmsCheck');
        if( $request->authno == $authArr['authno']){
          try{
            $userdata = User::where( ['id'=>Auth::user()->id])->first();
            $userdata->phone = $authArr['tel'];
            $userdata->save();
          }catch ( \Exception $e){
            return $this->error('전화번호 수정중 오류가 발생했습니다', 422);
          }
          $request->session()->forget('userSmsCheck');
          return $this->success(['phone'=>$userdata->phone]);
        }else return $this->error('인증번호가 틀립니다.', 422);
    }else {
      return $this->error('인증 내역을 찾을 수 없습니다. 다시 한번 인증해주세요', 422);
    }
  }
  function modifyPrc(Request $request){

    $messages = [
        'nickname.*' => '닉네임(2~10자)을 적어주세요.',
        'name.*' =>'2~10자로 이름을 적어주세요',
    ];
    $data = $this->validate($request, [
      'nickname' => 'bail|required|string|min:2|max:20',
      'name' => 'bail|nullable|string|min:2|max:10',
     ],$messages);
     $data=['nickname'=>$request->nickname, 'name'=>$request->name];
     $user = User::where( ['id'=>Auth::user()->id])->first();

     if (!$user ) return $this->error('회원 정보를 찾을  수 없습니다.', 422);

     try{
       $user->nickname = $request->nickname;
       $user->name = $request->name;
       $user->save();
       return $this->success();
     }catch ( \Exception $e){
       return $this->error('수정 중 오류가 발생했습니다', 422);
     }
  }

}
