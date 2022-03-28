<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\Models\AuctionCleanOrder;


class CleanorderController extends Controller
{
	use ApiResponser;
	public function __construct() {
		$this->stype=["1"=>'입주청소',"2"=>'거주청소',"3"=>'사무실청소',"4"=>'이사청소'];
		$this->spacetypes = [
			'room'=>'방','toilet'=>'화장실','veranda'=>'베란다'
		];
		$this->data=[];
		$this->default = [
			'm_uid'=>0, 'contact_name'=>'','order_path'=>'1'
			,'s_uid'=>'0','s_with2'=>'2','s_with3'=>'0','s_with4'=>'0'
			,'company'=>'','passwd'=>'','note'=>'','user_memo'=>'','memo'=>''
			,'com_num'=>'0','reg_date'=>Carbon::now()->format('Y-m-d H:i:s'),'aircon_yn'=>'Y',
		];
  }

	public function step1(Request $request){
		$res = $this->stepTypeCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>1, 'data'=> $res->errors() ]);
		}
		//$this->makelog($request, 'contactpop', '4' );
		return $this->success( );
	}
	private function stepTypeCheck($request){
		$this->errors = null;
		$messages = [
				'stype.*' =>'청소종류를 선택해주세요',
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'stype' => 'bail|required|in:1,2,3,4',
		 ],$messages);
		 if ($validator->fails()) return $validator;
		 else return true;
	}
  public function step2(Request $request){
		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2,'data'=>['mdate'=>$res]]);

    return $this->success();
  }
	private function stepMdateCheck(Request $request ){
		if( $request->negotiable =='Y') {
			return true;
		}
		$messages = [
				'mdate.required' =>'청소날짜를 선택해주세요',
				'mdate.*' =>'올바른 청소날짜를 선택해주세요',
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'mdate' => 'bail|required|date',
		 ],$messages);
		 if ($validator->fails()) return $validator->messages()->first();
		 $mdateCarbon =  Carbon::createFromFormat('Y-m-d',$request->mdate);
		 $diff_day = $mdateCarbon->diffInDays( Carbon::now() );
		 if( $diff_day > 200 ) return "청소 날짜는 최대 200일 안으로 선택하셔야 합니다.";
		 else return true;
	}
  public function step3(Request $request){
		$res = $this->stepBuildingCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>3, 'data'=> $res->errors() ]);
		}
		//$this->makelog($request, 'contactpop', '4' );
		return $this->success( );
  }
	private function stepBuildingCheck($request){
		$messages = [
				'clean_building.*' =>'건물형태를 선택해주세요',
				'clean_space.*'=>'공간형태를 선택해주세요'
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'clean_building' => 'bail|required|in:1,2,3,4,5,6',
			'clean_space' => 'bail|required|in:일반,베란다확장형,테라스형',
		 ],$messages);
		 if ($validator->fails()) return $validator;
		 else return true;
	}
  public function step4(Request $request){
		$res = $this->stepOptionCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>4, 'data'=> $res->errors() ]);
		}
		return $this->success( );
  }
	private function stepOptionCheck($request){
		if( $request->nooption=='nooption') {
			$this->data['options'] = [];
			return true;
		}else {
			$messages = [
				'options.*' =>'건물형태를 선택해주세요',
			];
			//$data = $this->validate($request, [
			$validator = Validator::make($request->all(),[
				'options' => 'bail|required|array|min:1',
			 ],$messages);
			if ($validator->fails()) return $validator;
		}
		return true;
	}
  public function step5(Request $request){
		$res = $this->stepSpaceCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>5, 'data'=> $res->errors() ]);
		}
		return $this->success( $request->all() );
  }
	private function stepSpaceCheck($request){
		$data['num'] = [];
		if( $request->room_except =='Y') {
			$this->data['room_num'] = '0';
			$data['num']['방']=false;
		}else {
			$messages = [
				'room_num.*' =>'방갯수를 선택해주세요',
			];
			//$data = $this->validate($request, [
			$validator = Validator::make($request->all(),[
				'room_num' => 'bail|required||integer|min:1|digits_between: 1,99',
			 ],$messages);
			if ($validator->fails()) return $validator;
			$data['num']['방'] = $request->room_num;
		}
		if( $request->toilet_except =='Y') {
			$this->data['toilet_num'] = '0';
			$data['num']['화장실']=false;
		}else {
			$messages = [
				'toilet_num.*' =>'방갯수를 선택해주세요',
			];
			//$data = $this->validate($request, [
			$validator = Validator::make($request->all(),[
				'toilet_num' => 'bail|required||integer|min:1|digits_between: 1,99',
			 ],$messages);
			if ($validator->fails()) return $validator;
			$data['num']['화장실']=$request->toilet_num;
		}
		if( $request->veranda_except =='Y') {
			$this->data['veranda_num'] = '0';
			$data['num']['베란다']=false;
		}else {
			$messages = [
				'veranda_num.*' =>'방갯수를 선택해주세요',
			];
			//$data = $this->validate($request, [
			$validator = Validator::make($request->all(),[
				'veranda_num' => 'bail|required||integer|min:1|digits_between: 1,99',
			 ],$messages);
			if ($validator->fails()) return $validator;
			$data['num']['베란다']=$request->veranda_num;
			$type = "veranda_num";
			//dd( $request->{$type} );
		}

		$messages = [
				's_addr1.*' =>'주소를 검색해주세요',
				's_zip1.*' =>'주소를 검색해주세요',
				's_addr2.*' =>'상세주소를 적어주세요',
				's_pyeong.*' =>'평수를 적어주세요',
        's_floor.*' =>'층수를 적어주세요',
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			's_addr1' => 'bail|required|string',
			's_zip1'=> 'bail|required|numeric',
			's_addr2' => 'bail|required|string',
			's_pyeong'=>'bail|required|min:1|between: 1,1000.99',
			's_floor'=>'bail|required|integer|min:1|between: 1,180',
		 ],$messages);
		 if ($validator->fails()) return $validator;
		 $this->data['clean_addr_pyoung'] = $request->s_pyeong;

		return true;
	}
	private function checkSpaceNum($request, $type){

		if( $request->{$type."_except"} =='Y') {
			$this->data[$type.'_num'] = '0';
			return [$type=>false];
		}else {
			$messages = [
				$type.'_num.*' =>$type.'갯수를 선택해주세요',
			];
			//$data = $this->validate($request, [
			$validator = Validator::make($request->all(),[
				$type.'_num' => 'bail|required||integer|min:1',
			 ],$messages);
			if ($validator->fails()) return $validator;
			return [$this->spacetypes[$type]=> $request->{$type.'_num'} ];
			//dd( $request->{$type} );
		}
	}
	public function stepComplete(Request $request){
		return $this->success(  $this->data );
		$spacenums=[];
		foreach ( $this->spacetypes as $type=>$val){
			$res = $this->checkSpaceNum($request, $type);
			if ( !is_array( $res ) ) return $this->error($res->messages()->first() ,422,['step'=>5, 'data'=> $res->errors() ]);
			dump( $res );
			$spacenums[] = $res;
		}
		dd( $spacenums );

		$this->data = $request->all();
		$res = $this->stepTypeCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>1, 'data'=> $res->errors() ]);
		}
		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2,'data'=>['mdate'=>$res]]);
		$res = $this->stepBuildingCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>3, 'data'=> $res->errors() ]);
		}
		$res = $this->stepOptionCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>4, 'data'=> $res->errors() ]);
		}
		$res = $this->stepSpaceCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>5, 'data'=> $res->errors() ]);
		}

		return $this->success(  $this->data );
	}

}
