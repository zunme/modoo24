<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\AuctionTempOrder;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;

use App\Traits\ApiResponser;


class OrdertempController extends Controller
{
	use ApiResponser;
	public function simplyreg(Request $request){
		$messages = [
			't_name.*' => '고객명을 적어주세요.',
			't_hp.required' =>'연락처를 (-) 없이 숫자만 적어주세요.',
			't_hp.*' =>'올바른 연락처를 적어주세요.',
			't_kinds.*' => '이사종류를 선택해주세요.',
			't_dday.*' =>'이사일을 선택해주세요.',			
			'simplyRegPrivacy.*' =>'개인정보 수집에 동의해주세요.',
			'simplyRegJoint.*' =>'개인정보 제3자 제공에 동의해주세요.',
    ];
    $this->validate($request, [
			't_dday' => 'bail|required|date_format:Y-m-d',
			't_kinds' => 'bail|required|in:소형,가정,사무실',
      't_name' => 'bail|required|string|min:2|max:50',
      't_hp' => 'bail|required|digits_between:10,13|string',
			'simplyRegPrivacy'=> 'bail|required|in:Y',
			'simplyRegJoint'=> 'bail|required|in:Y',
     ],$messages);
		$data = $request->all();
		$data['t_type'] = '간편';
		$data['t_memo'] = "[ 신청 IP : ".$request->ip().']'.PHP_EOL;
		
		$dup = AuctionTempOrder::where([
			't_type'=> '간편',
			't_name'=> $data['t_name'],
			't_hp'=> $data['t_hp'],
			't_kinds'=> $data['t_kinds'],
			't_dday'=>$data['t_dday']
			])->count();
		if( $dup > 0 ) return $this->error('이미 등록하신 내역이 있습니다.', 422);
		try{
			AuctionTempOrder::create($data);
			return $this->success();
		}catch( \Exception $e){
			return $this->error('잠시후에 이용해주세요', 422);
		}
	}
}