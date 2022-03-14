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
use App\Models\AuctionBank;
use App\Models\AuctionOrderAssign;

use App\Models\AuctionStaff;
class ContactorderController extends Controller
{
	use ApiResponser;
	public function staffpop($staffid){
		 return view('Front.Poporder.staffinfoframe',compact(['staffid']));
	}
	# 결저일 부터의 오더 카운트
	private function order_cnt_charge($idx){
		$data = AuctionBank::where(['s_uid'=>$idx])
			->orderBy('uid','desc')
			->first();
		if( empty($data)) return [ "res"=>true,"indate"=>'', "count"=>'' ] ;

		$indate = $data->in_date;
		$count = AuctionOrder::select('*')
			->where(function ($query) use($idx) {
					$query->where('s_uid1','=',$idx)
						->orWhere('s_uid2','=',$idx)
						->orWhere('s_uid3','=',$idx);
				})
			->where(function ($query) use($indate) {
				$query->where('s_give_date1','>=',$indate)
					->orWhere('s_give_date2','>=',$indate)
					->orWhere('s_give_date3','>=',$indate);
			})->count();
			return [ "res"=>true,"indate"=>$indate, "count"=>$count ] ;
	}
	private function shuffleArray($array, $limit)
	{
	    $arrayCount = count($array);
			shuffle($array);
			$ret=[];
	    $limit = min($arrayCount, $limit);
	    for ($i = 0; $i < $limit; $i++) {
				$ret[] = $array[$i];
	    }

	    return $ret;
	}

	public function companylist(Request $request){
		//order갯수 제한
		$limit_flag = 'N';

		$check = $this->checkConmpleteStep( $request);
		if( $check !== true) return $check;
		// 이중오더, 히 모두이사, cpa승인
		$except = array("736", "80", "737");
		$gugnSearch = [];
		$addrInfo = $this->getAddressInfo($request->s_bcode);
		$gugnSearch['sidogugun'] = trim($addrInfo['sido']).' '.trim($addrInfo['gu']);
		$addrInfo = $this->getAddressInfo($request->e_bcode);
		$gugnSearch['e_sidogugun'] = trim($addrInfo['sido']).' '.trim($addrInfo['gu']);

		\DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

		$availdata = AuctionStaff::
						select('auction_staff.s_uid',
							'flat_rate_staff','s_share_cnt','s_share_day_cnt','close'
							,'auction_staff.point','auction_staff.service_point'
						)
						->leftJoin('auction_close', function($q) use ($request){
							$q->on('auction_staff.s_uid', '=', 'auction_close.s_uid')
								->where( 'now_date','=',$request->mdate)
								->where('close','>','0');
						})
						->where([
							"auction_staff.type"=>"이사",// 지점회원
							"auction_staff.s_level"=>"2",// 이사업체
							['auction_staff.s_onout','<>','2'],// 거래중지없체가 아닌 지점
							['auction_staff.s_ceo_hp','<>',''],// 핸드폰번호가 있는 지점만
							 "auction_staff.s_share_flag"=> 'Y',// 분배허용 여부
							 "auction_staff.".$this->getClassifyColumn( $request->movingtype) => '1',	// 이사 종류 - 가정, 사무실, 용달 중 1인것 가져옴
						])
						->whereNotIn('auction_staff.s_uid', $except )// 자동분배 않되는 idx
						/*
						// 정액제 or 일반 이지만 포인트 20000 이상
						->where(function ($query) {
							$query->where(['flat_rate_staff'=>'Y'])
							->orwhere(function ($query) {
								$query->where('flat_rate_staff','=','N')
										->where(\DB::raw('(auction_staff.point + auction_staff.service_point) >= 20000'));
							});
						})
						*/
						->where(function ($query) use($gugnSearch) {
							$query->where('s_city','like', '%'.$gugnSearch['sidogugun'].'%')
							->orwhere(function ($query) use($gugnSearch) {
								$query->where('s_destination_flag','=', 'Y')
								->where('s_destination','like', '%'.$gugnSearch['e_sidogugun'].'%');
							});
						})
						/*
						->where(function ($query) {
							$query->whereNull('auction_close.close')
								->orwhere('auction_close.close','=','0');
						})
						*/
						->groupBy('auction_staff.s_uid')
						->get();

		$availdata->makeHidden(['equipments_arr','flat_rate_staff_name',
					'note_arr','s_gubun_name','s_level_name','s_pay_arr',
					's_staff_number','sclassify']);

		$retAvailData = [];
		$exceptedAvailData=[];

		foreach( $availdata as $row){
			//클로즈 된 업체
			if( $row->close > 0 ){
				if( $row->flat_rate_staff == 'Y' ) $exceptedAvailData[] = $row->s_uid;
				else if(  $row->flat_rate_staff=='N' ) $exceptedAvailData[] = $row->s_uid;
				continue;
			}
			//포인트 부족
			if ( $row->flat_rate_staff=='N' && $row->point + $row->service_point < '20000'){
				$exceptedAvailData[] = $row->s_uid;
				continue;
			}

			//제한풀렸을경우 모두
			if( $limit_flag =='Y') $retAvailData[] = $row;
			//제한걸린경우
			else {
				//정액제는 기간동안 체크추가
				if( $row->flat_rate_staff == 'Y' ){
					$countFromCharging=$this->order_cnt_charge($row->s_uid);
					if( $countFromCharging['res'] === false) continue;
					else if( $countFromCharging['count'] >= $row->s_share_cnt) {
						$exceptedAvailData[] = $row->s_uid;
						continue;
					}

				}
				//정액제, 일반제 일갯수 체크
				if( $row->flat_rate_staff == 'N' ||  $row->flat_rate_staff == 'Y' ){
					$countToday = AuctionOrderAssign:: where(['s_uid'=>$row->s_uid])
						->whereDate('s_give_date',Carbon::today())->count();
					if( $countToday >= $row->s_share_day_cnt ) {
						$exceptedAvailData[] = $row->s_uid;
						continue;
					}
					$retAvailData[] = $row->s_uid;
				}
			}
		}

		$retAvailData = $this->shuffleArray($retAvailData,10); //랜덤추출 10개까지
		$exceptedAvailData = $this->shuffleArray($exceptedAvailData,5); //랜덤추출 5개까지

		$allids = array_merge($retAvailData,$exceptedAvailData);

		$list = AuctionStaff::
						select('auction_staff.s_uid','auction_staff.s_company',
							\DB::raw("if(forcestar > avgstar, forcestar,avgstar) as star"),
							\DB::raw("ifnull( count(auction_bbs_postscript.b_uid),0 ) as review_cnt")
						)
						->leftJoin('star_points','auction_staff.s_uid','=','star_points.auction_staff_uid')
						->leftJoin('auction_bbs_postscript', function($q){
							$q->on('auction_staff.s_uid','=', 'auction_bbs_postscript.b_worker_idx')
								->where('auction_bbs_postscript.b_type','=','이사')
								->where('auction_bbs_postscript.b_atype','=','후기')
								->where('auction_bbs_postscript.b_admin_flag','=','Y')
								;
						})
						->whereIn('auction_staff.s_uid', $allids)
						->groupBy('auction_staff.s_uid')->get();
						;
		$list->makeHidden(['equipments_arr','flat_rate_staff_name',
					'note_arr','s_gubun_name','s_level_name','s_pay_arr',
					's_staff_number','sclassify']);

		$availdata=[];
		$closeddata=[];

		foreach ( $list as &$row){
			$temp = $this->companyGrade($row->star);
  		$row->gradeTitle = $temp['title'];
  		$row->gradePic = $temp['pic'];
			if( in_array( $row->s_uid, $retAvailData) ) 	$availdata[] = $row;
			else $closeddata[] = $row;
		}

		//dd( $this->getEloquentSqlWithBindings($data) );
		$data = ['avail'=>$availdata, 'closed'=>$closeddata];
		return $this->success($data);
	}
	public static function getEloquentSqlWithBindings($query)
	{
	    return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
	        return is_numeric($binding) ? $binding : "'{$binding}'";
	    })->toArray());
	}

	private function checkConmpleteStep($request){
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1]);
		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>3, 'data'=> $this->errors]);
		$res = $this->stepUserDataCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>4, 'data'=> $this->errors]);
		return true;
	}
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

  public function stepcomplete( Request $request){
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1]);

		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);

		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>3, 'data'=> $this->errors]);

		$res = $this->stepUserDataCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>4, 'data'=> $this->errors]);
		$classify = 0;
		switch ( $request->movingtype) {
			case 'home':
				$classify = 1;
				break;
			case 'small':
				$classify = 3; //용달로매칭
				break;
			case 'office':
				$classify = 2;
				break;
			default:
				// code...
				break;
		}
		$data = [
			'm_uid'=>0, 'order_path'=>1
			,'s_with2'=>0,'s_with3'=>0,'s_with4'=>0
			,'mdate'=>$request->mdate,'name'=>$request->register_name
			,'passwd'=>$this->format_tel($request->register_phone), 'hp'=>$request->register_phone
			,'classify'=>$classify, 'stype'=>0 //이사타입 일반
			,'s_zip1'=>$request->s_zip1,'s_addr1'=>$request->s_zip1,'s_addr2'=>$request->s_addr2
			, 'e_zip1'=>$request->e_zip1, 'e_addr1'=>$request->e_addr1
			,'ton'=>0,'cbm'=>0,'goods'=>0,'note'=>$request->memo,'memo'=>''
			,'kaku'=>'','junja'=>'','jubang'=>'','kita'=>'','kaku_s'=>'','junja_s'=>'','jubang_s'=>'','kita_s'=>''
			,'cstype'=>0, 'cafe_name'=>'모두이사_official_visit2'
			,'aircon_yn'=>'Y','aircon_wall_cnt'=>0,'aircon_stand_cnt'=>0,'aircon_system_cnt'=>0,'aircon_double_cnt'=>0
			,'type'=>'','user_memo'=>'','area'=>'A'


			,'share_price'=>0, 'share_status'=>'ING','auto_share'=>'N'

			,'clean_yn'=>$request->use_clean=='Y'? 'Y' :'N'
			,'s_uid' => $request->internet_call =='Y' ? 1 : 0
			,'keep'=> $request->use_container =='Y' ? 1 : 0

			,'bds_id'=>'', 'reg_company_type'=>'모두이사'

		];

		
		if( $request->contact_list_recommend =='recommend' || $request->contact_list_forced =='forced' ){
			return $this->error('업체1를 선택해주세요',422,['step'=>5 ]);
		}
		else if( $request->contact_list_recommend =='selection') {
			return $this->error('업체2를 선택해주세요',422,['step'=>5 ]);
		}else return $this->error('업체를 선택해주세요',422,['step'=>5 ]);
		//company

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

	//이사종류 TODO 이름 다른것으로 고칠것...getClassifyColumn
	private function getClassifyColumn( $movingtype){
		switch($movingtype){
			case "small" :
				return "s_classify3";
			case "home" :
				return "s_classify1";
			case "office" :
				return "s_classify2";
			default :
				return '0';
		}
	}

}
