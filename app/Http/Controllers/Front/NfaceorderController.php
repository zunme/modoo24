<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\User;


class NfaceorderController extends Controller
{
	use ApiResponser
	;
	/* 도착지 출발지 체크 */
  function step1(Request $request){
		/*step1 check */
    $res = $this->stepAddressCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*end step1 check */

    return $this->success( );
  }
	/* 이사일 체크 */
	function step2(Request $request){
		/*step1 check */
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*step2 check */
    $res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>2]);


    return $this->success( );
  }
	/* 이사종류 & 이삿짐량 선택 */
	function step3(Request $request){
		/*step1 check */
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*step2 check */
    $res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>2]);
		/*step2 check */
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);

    return $this->success(['command'=>'changeNfaceGoodsMethod'] );
  }

  private function stepAddressCheck(Request $request ){
    $messages = [
        's_addr1.*' =>'출발지 주소를 검색해주세요',
        's_zip1.*' =>'출발지 주소를 검색해주세요',
        's_addr2.*' =>'출발지 상세주소를 적어주세요',

        's_pyeong.*' =>'출발지의 평수를 적어주세요',
        's_floor.*' =>'출발지의 층수를 적어주세요',

        'e_addr1.*' =>'도착지 주소를 검색해주세요',
        'e_zip1.*' =>'도착지 주소를 검색해주세요',
        'e_pyeong.*' =>'도착지의 평수를 적어주세요',
        'e_floor.*' =>'도착지의 층수를 적어주세요',
    ];
    //$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
      's_addr1' => 'bail|required|string',
      's_zip1'=> 'bail|required|numeric',
      's_addr2' => 'bail|required|string',
      's_pyeong'=>'bail|required|numeric',
      's_floor'=>'bail|required|numeric',

      's_ev_no'=>'bail|nullable|in:Y,on',

      's_park_no'=>'bail|nullable|in:Y,on',

      'e_addr1' => 'bail|required|string',
      'e_zip1'=> 'bail|required|numeric',
      'e_pyeong'=>'bail|required|numeric',
      'e_floor'=>'bail|required|numeric',

      'e_ev_no'=>'bail|nullable|in:Y,on',
      'e_park_no'=>'bail|nullable|in:Y,on',

			'use_clean'=>'bail|nullable|in:Y,on',
			'internet_call'=>'bail|nullable|in:Y,on',

     ],$messages);
		 if ($validator->fails()) return $validator->messages()->first();
		 else return true;
  }
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
	private function stepCarryingMethodCheck(Request $request ){
		$messages = [
				'movingtype.*' =>'소형,가정,사무실 이사 중 하나를 선택해주세요',
				'movingmethod.*'=>'(반)포장이사, 일반이사를 선택해주세요',
				'moving-goods-method.*'=>'이사짐량 확인 방법을 선택해주세요',
				's_help_no.*'=>'함께 옮겨 주실수 있는지 선택해주세요',
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'movingtype' => 'bail|required|in:small,home,office',
			'movingmethod'=>'bail|required|in:packaging,half-packaging,carrying',
			'moving-goods-method'=>'bail|required|in:picture,list',
			's_help_no'=>'bail|nullable|in:Y,on',
		 ],$messages);
		 if ($validator->fails()) return $validator->messages()->first();
		 else return true;
	}

	private function tranceData($data){
		$checkoption = ['s_ev_no', 's_park_no','e_ev_no', 'e_park_no','use_clean','internet_call','s_help_no'];
		foreach ( $checkoption as $opt){
			$data[$opt] = ( !isset($data[$opt]) ||  !in_array($data[$opt], ['Y','on']) ) ? 'N': 'Y';
		}
		return $data;
	}
}
