<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\Models\BulletinSidoCopy;
use App\Models\AuctionOrder;

class ContactorderController extends Controller
{
	use ApiResponser;
  public function step1(Request $request){

    $res = $this->stepCarryingMethodCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);

    //$this->makelog($request, 'contactpop', '2' );
    return $this->success( );
  }

	public function step2(Request $request){

		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);

    //$this->makelog($request, 'contactpop', '3' );
    return $this->success( );
  }
	public function step3(Request $request){
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>3, 'data'=> $this->errors]);
		//$this->makelog($request, 'contactpop', '4' );
		return $this->success( );
	}
	public function step4(Request $request){
		$res = $this->stepUserDataCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>4, 'data'=> $this->errors]);
		//$this->makelog($request, 'contactpop', '5' );
		return $this->success( );
	}

  //이사종류 체크
  private function stepCarryingMethodCheck($request){
    $messages = [
        'movingtype.*' =>'가정, 소형원룸, 사무실 이사 중 하나를 선택해주세요',
    ];
    //$data = $this->validate($request, [
    $validator = Validator::make($request->all(),[
      'movingtype' => 'bail|required|in:small,home,office',
     ],$messages);
     if ($validator->fails()) return $validator->messages()->first();
     else return true;
  }
	//이사일체크
	private function stepMdateCheck(Request $request ){
		$messages = [
				'mdate.*' =>'이사일을 선택해주세요',
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'mdate' => 'bail|required|date',
		 ],$messages);
		 if ($validator->fails()) return $validator->messages()->first();
		 else return true;
	}
	//주소체크
	private function stepAddressCheck(Request $request ){
		$this->errors = null;
    $messages = [
        's_addr1.*' =>'출발지 주소를 검색해주세요',
        's_zip1.*' =>'출발지 주소를 검색해주세요',
        's_addr2.*' =>'출발지 상세주소를 적어주세요',

        'e_addr1.*' =>'도착지 주소를 검색해주세요',
        'e_zip1.*' =>'도착지 주소를 검색해주세요',

        'use_container.*'=>'보관이사 여부를 선택해주세요',
    ];
    //$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
      's_addr1' => 'bail|required|string',
      's_zip1'=> 'bail|required|numeric',
      's_addr2' => 'bail|required|string',

      'e_addr1' => 'bail|required|string',
      'e_zip1'=> 'bail|required|numeric',

      'use_container'=>'bail|nullable|in:Y',

			'use_clean'=>'bail|nullable|in:Y',
			'internet_call'=>'bail|nullable|in:Y',
     ],$messages);
		 if ($validator->fails()) { $this->errors = $validator->errors(); return $validator->messages()->first();}
		 else return true;
  }

	//정보입력체크
	private function stepUserDataCheck(Request $request){
		$messages = [
				'register_name.*'=>'신청인 이름을 적어주세요',
				'register_phone.*'=>'올바른 신청인 전화번호(숫자만)를 적어주세요',
				'agree1.*'=>'[이용약관 및 개인정보처리방침] 에 동의해주세요',
				'agree2.*'=>'[제 3 자 제공] 에 동의해주세요',
				'agree_marketing.*'=>'마케팅 동의를 확인해주세요',
				'memo.*'=>'메모를 확인해주세요',
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'register_name'=>'bail|required|string|min:2',
			'register_phone'=>'bail|required|digits_between:9,13',
			'agree1'=>'bail|required|in:Y,on',
			'agree2'=>'bail|required|in:Y,on',
			'agree_marketing'=>'bail|nullable|in:Y,on',
			'memo'=>'bail|nullable|string',
		 ],$messages);
		 if ($validator->fails()) { $this->errors = $validator->errors(); return $validator->messages()->first();}
		 return true;
	}
}
