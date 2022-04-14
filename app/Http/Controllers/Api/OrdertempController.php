<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\AuctionTempOrder;
use App\Models\AuctionOrder;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;

use App\Traits\ApiResponser;
use App\Libraries\Aligo;

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
		if( !isset($data['simplyMarketting']) || $data['simplyMarketting'] !='Y') $data['simplyMarketting'] = 'N';

		$data['t_type'] = '간편';
		$data['t_memo'] = "[ 신청 IP : ".$request->ip().']'.PHP_EOL;
		switch( $data['t_kinds'] ){
			case "가정" :
				$classify = 1;
			break;
			case "사무실" :
				$classify = 2;
			break;
			case "소형" :
				$classify = 3;
			break;
			default :
				$classify = 0;
		}
		if( $classify == 0 ) {
			return $this->error('이사종류를 확인 할 수 없습니다.', 422);
		}

		$newdata = [
			"name" => $data['t_name']
			, "passwd" => $data['t_hp']
			, "hp" => $this->tel($data['t_hp'])
			, "mdate" => $data['t_dday']
			, "order_path" => '1'
			, "stype" => '1'
			, "classify" => $classify
			, "cstype" => '0'
			, "cafe_name" => '모두이사_official_simple'
			, "reg_company_type" => '모두이사'
			,'s_with2'=>0,'s_with3'=>0,'s_with4'=>0
			,'goods'=>'','note'=>'','memo'=>''
			,'kaku'=>'','junja'=>'','jubang'=>'','kita'=>'','kaku_s'=>'','junja_s'=>'','jubang_s'=>'','kita_s'=>''
			,'aircon_yn'=>'N'
			,'aircon_wall_cnt'=>'0','aircon_stand_cnt'=>'0','aircon_system_cnt'=>'0','aircon_double_cnt'=>'0'
			,'type'=>'','user_memo'=>''
			,'area'=>'A','share_status'=>'ING','auto_share'=>'N','clean_yn'=>'N','bds_id'=>''
		];
		$dup = AuctionOrder::where( $newdata )->where('reg_date' , '>' , Carbon::now()->subDays(1) )->count();
	/*
		$dup = AuctionTempOrder::where([
			't_type'=> '간편',
			't_name'=> $data['t_name'],
			't_hp'=> $data['t_hp'],
			't_kinds'=> $data['t_kinds'],
			't_dday'=>$data['t_dday']
			])->count();
			*/
		if( $dup > 0 ) return $this->error('이미 등록하신 내역이 있습니다.', 422);
		try{
			//AuctionTempOrder::create($data);
			AuctionOrder::create($newdata);
			$aligo = new Aligo;
			$req["#{고객명}"] = $data['t_name'];
			$req["#{이사일}"] = $data['t_dday'];
			$req["#{이사종류}"] = $data['t_kinds'];
			$data = [
				'tpl_code'=>'TG_2976',
				'receiver_1'=>$data['t_hp'],
			];
			$res = $aligo->sendKakaoParser($data, $req);
			return $this->success();
		}catch( \Exception $e){
			return $this->error('잠시후에 이용해주세요', 422, $e->getMessage() );
		}
	}

	private function tel($tel){
		$tel = preg_replace("/[^0-9]*/s","",$tel);
		if (substr($tel,0,2) =='02' ) return preg_replace("/([0-9]{2})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3", $tel);
		else if(substr($tel,0,2) =='8' && substr($tel,0,2) =='15' || substr($tel,0,2) =='16'||  substr($tel,0,2) =='18'  ) return preg_replace("/([0-9]{4})([0-9]{4})$/","\\1-\\2",tel);
		else return preg_replace("/([0-9]{3})([0-9]{3,4})([0-9]{4})$/","\\1-\\2-\\3" ,$tel);
	}

}
