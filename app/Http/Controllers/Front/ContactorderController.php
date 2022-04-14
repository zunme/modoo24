<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\Models\BulletinSidoCopy;
use App\Models\AuctionOrder;
use App\Models\AuctionOrderTemp;

use App\Models\AuctionBank;
use App\Models\AuctionOrderAssign;
use App\Models\AuctionOrderNum;
use App\Models\AuctionShareOption;

use App\Models\AuctionCleanOrder;
use App\Models\AuctionStaff;
use App\Models\PointHistory;
use App\Models\Zipcode;

class ContactorderController extends Controller
{
	use ApiResponser;
	public function __construct() {
		$this->now = Carbon::now()->format('Y-m-d H:i:s');
		$msg = "\n\n";
		$msg .= '__________________________________'."\n";
		$msg .= '★모두이사 칭찬후기 이벤트★'."\n";
		$msg .= '모두이사 매칭업체 이사서비스를 받으시고'."\n";
		$msg .= '칭찬후기를 작성해주세요'."\n";
		$msg .= '작성해주신 모든 고객님께 커피쿠폰을 드립니다.'."\n";
		$msg .= '업체평가하기 → http://modoo24.net/v2/review/my ';
		$this->eventMessage = $msg;
	}
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
	private function shuffleArray($array, $limit) {
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
		$testerIp = [];//['221.154.134.3']; //사무실 IP

		$check = $this->checkConmpleteStep( $request);
		if( $check !== true) return $check;

		$except = array("736", "80", "737"); // 이중오더, 히 모두이사, cpa승인
		$testCompany = array(1137, 1141); // 0001, 0005

		$gugnSearch = [];
		$addrInfo = $this->getAddressInfo($request->s_bcode);
		$gugnSearch['sidogugun'] = trim($addrInfo['sido']).' '.trim($addrInfo['gu']);
		$addrInfo = $this->getAddressInfo($request->e_bcode);
		$gugnSearch['e_sidogugun'] = trim($addrInfo['sido']).' '.trim($addrInfo['gu']);

		\DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");

		$availdata = AuctionStaff::
						select('auction_staff.s_uid',
							'flat_rate_staff','s_share_cnt','s_share_day_cnt','close'
							,'auction_staff.point','auction_staff.service_point','s_share_flag'
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
//							 "auction_staff.s_share_flag"=> 'Y',// 분배허용 여부
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
			if( $row->s_share_flag != 'Y'){
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
		if( in_array($request->ip(), $testerIp ))  $retAvailData = array_merge( $retAvailData, $testCompany); //테스트추가
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
	public static function getEloquentSqlWithBindings($query){
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

		// 중복체크
		//contact_orderid , 01025376460

		$dup = AuctionOrder::where([
			'passwd'=> preg_replace('/[^0-9]/', '', $request->register_phone),
			'mdate'=>$request->mdate
		])
		->where('uid','<>', $request->contact_orderid)
		->count();
		if( $dup > 0 ){
			return $this->error('등록 된 이사정보가 있습니다',422,['step'=>4]);
		}

		//60일 이후 체크
		$mdateCarbon =  Carbon::createFromFormat('Y-m-d',$request->mdate);
		$diff_day = $mdateCarbon->diffInDays( Carbon::now() );

		$calldate = '';
		if( $diff_day > 60 ) {
			$diff_day_check = false;
			$calldate =  $mdateCarbon->subDay('60')->format('y년 m월 d일');
		}
		else $diff_day_check = true;

		$res = $this->savetemp($request);

		if ($res instanceof JsonResponse ) return $res;

		if( $res && !$diff_day_check){
			try{
				//60이후 이사 문자발송
				$msg = '[모두이사 방문견적 신청완료]'."\n";
				$msg .= '안녕하세요. '.$res->name.' 고객님, 모두이사입니다.'."\n";
				$msg .= '이사 견적 신청이 완료되었습니다.'."\n\n";
				$msg .= '이사일 : '.$res->mdate."\n";
				$msg .= '출발지 주소 : '.$res->s_addr1.' '.$res->s_addr2."\n";
				$msg .= '도착지 주소 : '.$res->e_addr1."\n\n";
				$msg .= '모두이사는 금일부터 60일 이내 이사 예정 고객님과 우수 이사업체를 매칭해드립니다.'."\n";
				$msg .= '고객님의 이사 예정일은 60일이 경과되어,'."\n";
				$msg .= '매칭 가능 날짜에 저희 상담원이 연락드리겠습니다.'."\n\n";
				$msg .= '모두이사를 이용해 주셔서 감사합니다.'."\n";
				$msg .= '이사 관련 문의 사항이 있으시면 연락주세요'."\n";
				$msg .= '문의 1600-7728';
				$msg.= $this->eventMessage;

				$sms_res = $this->sms( preg_replace('/[^0-9]/', '',$res->hp),'모두이사 입니다.', $msg);

			}catch (\Exception $e){
				;
			}
		}
		return $this->success( ['orderid'=>$res->uid,'diffday'=>$diff_day_check,'calldate'=>$calldate]);
	}
	private function getAreaCode( $addr ){
		$addr = trim(preg_replace('/\s+/', ' ', $addr));
		$addrArr = explode(' ', $addr);
		if( $addrArr[0]=='세종'){
			$data = Zipcode::where(['sido'=>'세종'])->first();
			if( !$data ) return 'A';
			else return $data->area;
		}else {
			$data = Zipcode::where(['sido'=>$addrArr[0], 'gugun'=>$addrArr[1]])->first();
			if( !$data ) {
				$data = Zipcode::where(['sido'=>$addrArr[0], 'gugun'=>$addrArr[1].' '.$addrArr[2]])->first();
				if( !$data ) return 'A';
				else return $data->area;
			}else return $data->area;
		}
		return 'A';
		//Zipcode
	}

	private function savetemp ( $request){
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
			'm_uid'=>0, 'contact_name'=>'','order_path'=>1
			,'s_with2'=>0
			,'mdate'=>$request->mdate,'name'=>$request->register_name
			,'passwd'=>$request->register_phone, 'hp'=>$this->format_tel($request->register_phone)
			,'classify'=>$classify, 'stype'=>'2' //이사타입 2로 고정
			,'s_zip1'=>$request->s_zip1,'s_addr1'=>$this->getReplaceAddr($request->s_addr1),'s_addr2'=>$request->s_addr2
			, 'e_zip1'=>$request->e_zip1, 'e_addr1'=>$this->getReplaceAddr($request->e_addr1)
			,'s_zip2'=>$this->getSigungucode($request->s_bcode)
			,'e_zip2'=>$this->getSigungucode($request->e_bcode)
			,'ton'=>0,'cbm'=>0,'goods'=>0,'note'=>$request->memo?$request->memo:'','memo'=>''
			,'kaku'=>'','junja'=>'','jubang'=>'','kita'=>'','kaku_s'=>'','junja_s'=>'','jubang_s'=>'','kita_s'=>''
			,'cstype'=>0, 'cafe_name'=>'모두이사_official_visit2'
			,'aircon_wall_cnt'=>0,'aircon_stand_cnt'=>0,'aircon_system_cnt'=>0,'aircon_double_cnt'=>0
			,'type'=>'','user_memo'=>'','area'=>$this->getAreaCode($this->getReplaceAddr($request->s_addr1))

			,'share_price'=>0, 'share_status'=>'ING','auto_share'=>'N'

			,'clean_yn'=>$request->use_clean=='Y'? 'Y' :'N'
			,'s_uid' => $request->internet_call =='Y' ? 1 : 0
			,'s_with3'=> $request->interior_call =='Y' ? 1 : 0
			,'s_with4'=>$request->agree_marketing=='Y' ? 1 : 0
			,'keep'=> $request->use_container =='Y' ? 1 : 0
			,'aircon_yn'=>$request->aircon_yn=='Y' ? 'Y' : 'N'
			,'bds_id'=>'', 'reg_company_type'=>'모두이사'
		];
		$mdateCarbon =  Carbon::createFromFormat('Y-m-d',$request->mdate);
		$diff_day = $mdateCarbon->diffInDays( Carbon::now() );
		if( $diff_day > 60 ) $data['contact_name']="60일";
		else $data['contact_name']="임시저장";

		\DB::beginTransaction();
		try{
			if( $request->contact_orderid ){
				$order = AuctionOrder::find($request->contact_orderid);
				if( $order){
					if( $order->share_status == 'DONE') return $this->error('이미 견적신청이 완료된 내용입니다.',422,['step'=>1]);
					$order->update($data);
				}else $order = AuctionOrder::create($data);

			}else{
				$order = AuctionOrder::create($data);
			}
			if ($diff_day > 60 && $order->clean_yn =='Y' ){
				$cleandata = AuctionCleanOrder::where(['s_with2'=>1, 'order_uid'=>$order->uid])->first();
/* todo 태스트 문구 뺄것 */
				if( !$cleandata ) {
					$clean=[
						'contact_name'=>'60일',
						'order_path'=>'1',//온라인
						's_uid'=>'0',
						's_with2'=>'1',//방문
						's_with3'=>'0',
						's_with4'=>'0',
						'mdate'=>$data['mdate'],
						'company'=>'',
						'name'=>$data['name'],
						'passwd'=>'',
						'hp'=>$data['hp'],
						'stype'=>'1',//입주청소
						's_addr1'=>$data['e_addr1'],
						's_addr2'=>'',
						'note'=>'',
						'user_memo'=>'테스트중입니다 분배하지말아주세요',
						'memo'=>'',
						'com_num'=>'0',
						'reg_date'=>Carbon::now()->format('Y-m-d H:i:s'),
						'aircon_yn'=>'Y',//우선은 있는것으로
						'type'=>'',//주거종류 선택없음
						'share_status'=>'ING',
						'clean_staff_cnt'=>'0',
						'clean_elevator'=>'N',
						'clean_addr_pyoung'=>'',
						'order_uid'=>$order->uid,
					];
					$cleanins = AuctionCleanOrder::create($clean);
				}else {
					$clean=[
						'mdate'=>$data['mdate'],
						'name'=>$data['name'],
						'hp'=>$data['hp'],
						's_addr1'=>$data['e_addr1'],
						'clean_elevator'=>'N',
						'clean_addr_pyoung'=>'',
					];
					$cleandata->update( $clean);
				}

			}
			\DB::commit();
		}catch (\Exception $e){
			\DB::rollback();
			dd( $e->getMessage());
			return $this->error('저장중 오류가 발생하였습니다',422,['step'=>4]);
		}

		return $order;
	}

  public function stepcomplete( Request $request) {
		$res = $this->checkConmpleteStep($request);
		if( $res !== true) return $res;

		//60일 이후 체크
		$mdateCarbon =  Carbon::createFromFormat('Y-m-d',$request->mdate);
		$diff_day = $mdateCarbon->diffInDays( Carbon::now() );

		if( $diff_day > 60 ){
			return $this->error('이사 날짜를 다시 선택해주세요',422,['step'=>2]);
		}

		if($diff_day <= 30) $_day = 30;
		elseif($diff_day > 30 && $diff_day <= 50) $_day = 50;
		elseif($diff_day > 50 && $diff_day <= 65) $_day = 65;
		elseif($diff_day > 65 && $diff_day <= 90) $_day = 90;
		else return $this->error('이사 날짜를 다시 선택해주세요',422,['step'=>2]);


		$classify = 0;
		$_stype="";

		switch ( $request->movingtype) {
			case 'home':
				$classify = 1;
				$_stype="가정";
				break;
			case 'small':
				$classify = 3; //용달로매칭
				$_stype="용달";
				break;
			case 'office':
				$classify = 2;
				$_stype="사무실";
				break;
			default:
				// code...
				break;
		}
		if( $classify < 1) return $thiw->error('이사종류를 찾을 수 없습니다.',422,['step'=>1]);

		$data = [
			'mdate'=>$request->mdate,'name'=>$request->register_name
			,'passwd'=>$request->register_phone, 'hp'=>$this->format_tel($request->register_phone)
			,'classify'=>$classify, 'stype'=>'2' //이사타입 2로 고정
			,'s_zip1'=>$request->s_zip1,'s_addr1'=>$this->getReplaceAddr($request->s_addr1),'s_addr2'=>$request->s_addr2
			, 'e_zip1'=>$request->e_zip1, 'e_addr1'=>$this->getReplaceAddr($request->e_addr1)
			,'s_zip2'=>$this->getSigungucode($request->s_bcode)
			,'e_zip2'=>$this->getSigungucode($request->e_bcode)
			,'note'=>$request->memo?$request->memo:''
			,'clean_yn'=>$request->use_clean=='Y'? 'Y' :'N'
			,'s_uid' => $request->internet_call =='Y' ? 1 : 0
			,'s_with3'=> $request->interior_call =='Y' ? 1 : 0
			,'s_with4'=>$request->agree_marketing=='Y' ? 1 : 0
			,'keep'=> $request->use_container =='Y' ? 1 : 0
			,'aircon_yn'=>$request->aircon_yn=='Y' ? 'Y' : 'N'
		];

		if( $diff_day > 60 ) $data['contact_name']="60일";
		else $data['contact_name']="";

		$companies_data='';

		if( $request->contact_list_recommend =='recommend' || $request->contact_list_forced =='forced' ){
			$data['contact_list_recommend'] = 'recommend';
		}
		else if( $request->contact_list_recommend =='selection') {
			if ( count($request->company) < 1) return $this->error('업체를 선택해주세요',422,['step'=>5 ]);
			$data['contact_list_recommend'] = 'selection';
			$companies_data = $this->makeCompanys( $request);

			//차감금액 설정시 필요
			$staff_cnt = count( $companies_data['create']);

			if( $staff_cnt < 1 ) return $this->error('업체를 선택해주세요(2)',422,['step'=>5 ]);

			$data['com_num'] = count($request->company);//분개갯수
			$data['contact_name']="고객선택";
			$data = array_merge( $data, $companies_data);

		}else return $this->error('이사업체 추천받기 또는 직접선택을 선택해주세요',422,['step'=>5 ]);

		//지역구분
		$areaArr = $this->getAddressInfo( $request->s_bcode );
		$sql = "SELECT area, sido, gugun FROM zipcode
				WHERE sido='".$areaArr['sido']."' AND gugun LIKE('%".$areaArr['gu']."%')
				GROUP BY area, sido, gugun limit 1";
		$areaData = \DB::select( $sql );
		$areaZone = 'area'.(!isset( $areaData[0] ) || !isset($areaData[0]->area)  ?'A': $areaData[0]->area);

		// 세팅된 금액정보 미리 가져오기 : $discount_price
		if( $data['contact_list_recommend'] == 'selection' ){
			$sql = "SELECT * FROM price_list ORDER BY idx DESC LIMIT 1";
			$pricetemp = \DB::select($sql);
			$pricelist = json_decode($pricetemp[0]->{$areaZone}, true);
			$area_price = $pricelist[$_day][$_stype];
			if($area_price["share3"]=="" || $area_price["share2"]=="" || $area_price["share1"]==""){
				return $this->error('분배 조건에 맞는 금액설정이 확인되지 않습니다. [이사업체추천받기] 로 진행해주세요',422,['step'=>5]);
			}
			$discount_price = $area_price["share".$staff_cnt];
		}

		//company
		$order = AuctionOrder::find($request->contact_orderid);
		if( !$order){
			return $this->error('전단계가 완료되지 않았습니다.',422,['step'=>4]);
		}
		/* 분배된업체 또는 접수자가 임시저장이 아니면 저장안하고 종료 */
		if( $order->share_status == 'DONE' || $order->contact_name !='임시저장') return $this->success();


		\DB::beginTransaction();
		try{

			//기존 데이터 있을수 있으니 삭제
				$assign = AuctionOrderAssign::where(['o_uid'=>$order->uid])->delete();
				AuctionShareOption::where(['aso_order_idx'=> $order->uid ])->delete();

			if( $data['contact_list_recommend'] == 'selection' ){
				// 세팅된 금액정보 미리 가져오기
				$auctionordernumdata=[
					'order_uid'=>$order->uid,
					's_uid1'=>'0','s_id1'=>'','s_company1'=>'',
					's_uid2'=>'0','s_id2'=>'','s_company2'=>'',
					's_uid3'=>'0','s_id3'=>'','s_company3'=>'',
					'now'=>$this->now
				];
				$staff_hpArr = [];
				$temp_companies_data_create = [];
				foreach( $companies_data['create'] as &$row ){
					$row['o_uid'] = $order->uid;

					// TODO 테스트시 삭제
					//$row['s_uid'] = 1139;//80

					$staffPointData = AuctionStaff::find( $row['s_uid']);

					$row['hp']='';
					$temp_tel_arr = [];
					$temp_tel = preg_replace('/[^0-9]/', '', $staffPointData->s_ceo_hp);
					if( $temp_tel != '' ) $temp_tel_arr[] = $temp_tel;
					$temp_tel = preg_replace('/[^0-9]/', '', $staffPointData->s_ceo_hp_plus);
					if( $temp_tel != '' ) $temp_tel_arr[] = $temp_tel;
					if( count($temp_tel_arr) > 0 ){
						$row['hp']=implode(",", $temp_tel_arr);
					}
					$row['app_push_id'] = $staffPointData->app_push_id;

					/*start AuctionOrderNum */
					$auctionordernumdata['s_uid'.$row['assign_sort']] = $row['s_uid'];
					$auctionordernumdata['s_id'.$row['assign_sort']] = $row['s_id'];
					$auctionordernumdata['s_company'.$row['assign_sort']] = $row['s_company'];
					/*end AuctionOrderNum */

					/* start order assign */
					AuctionOrderAssign::create($row);
					/* end order assign */

					/* start point */


					$temphistory =[];
					$temphistory['discount_price'] = $discount_price;
					$temphistory['flat_rate_staff'] = $staffPointData->flat_rate_staff;
					$temphistory['staff_cnt'] = $staff_cnt;

					/*
					// TODO 테스트시 삭제
					$staffPointData->point = 10000;
					$staffPointData->service_point = 10000;
					$staffPointData->flat_rate_staff = 'Y';
					*/

					if( $staffPointData->flat_rate_staff =='Y'){
						$temphistory['before_point'] = $staffPointData->point;
						$temphistory['before_service_point'] = $staffPointData->service_point;
						$temphistory['point'] = $staffPointData->point;
						$temphistory['service_point'] = $staffPointData->service_point;
						$temphistory['use_point'] = 0;
						$temphistory['use_service'] = 0;
					}else{
						//차감액 측정
						if( $staffPointData->point >= $discount_price ) {
							$temphistory['before_point'] = $staffPointData->point;
							$temphistory['before_service_point'] = $staffPointData->service_point;
							$temphistory['point'] = $staffPointData->point - $discount_price;
							$temphistory['service_point'] = $staffPointData->service_point;
							$temphistory['use_point'] = $discount_price;
							$temphistory['use_service'] = 0;
						}else if( $staffPointData->point + $staffPointData->service_point >= $discount_price){
							$temp_diffpoint = $discount_price - $staffPointData->point;
							$temphistory['before_point'] = $staffPointData->point;
							$temphistory['before_service_point'] = $staffPointData->service_point;
							$temphistory['point'] =  0 ;
							$temphistory['service_point'] = $staffPointData->service_point - $temp_diffpoint;
							$temphistory['use_point'] = $staffPointData->point;
							$temphistory['use_service'] = $temp_diffpoint;
						}else{
							$temp_diffpoint = $discount_price - $staffPointData->point;
							$temphistory['before_point'] = $staffPointData->point;
							$temphistory['before_service_point'] = $staffPointData->service_point;
							$temphistory['point'] =  0 ;
							$temphistory['service_point'] =  0 ;
							$temphistory['use_point'] = $staffPointData->point;
							$temphistory['use_service'] =  $staffPointData->service_point;
						}

					}
					$row['point_log'] = $temphistory;

					//로그
					$content = '수동분배시스템에 의해 수정되었음.';
					$content .= '(오더:'.$order->uid.' / 분배업체수:'.$staff_cnt.' / 포인트:'.$temphistory['before_point'].'=>'.$temphistory['point'].' / 서비스포인트:'.$temphistory['before_service_point'].'=>'.$temphistory['service_point'].')';
					$log = array(
						'o_uid' => $row['o_uid'] // 오더 idx
						, 's_uid' => $row['s_uid'] // 지점 idx
						, 'm_uid' => "10" // 웹관리자 idx
						, 'content' => $content
						, 'point' => $staffPointData->flat_rate_staff =='Y' ? 0 : $discount_price
						, 'old_point' => $temphistory['before_point']
						, 'new_point' => $temphistory['point']
						, 'old_service_point' => $temphistory['before_service_point']
						, 'new_service_point' => $temphistory['service_point']
						, 'type' => '자동분배'
					);

					//로그
					PointHistory::create( $log );

					//차감
					if( $staffPointData->flat_rate_staff !='Y' ){
						$staffPointData->point = 	$temphistory['point'];
						$staffPointData->service_point = 	$temphistory['service_point'];
						$staffPointData->save();
					}
					/* end point */

					// 분배 옵션 - 상태값, 구분(일반, 역경매) 레코드 추가

					AuctionShareOption::create(['aso_order_idx'=>$row['o_uid'], 'aso_reg_idx'=> $row['s_uid'] ]);
					$temp_companies_data_create[] = $row;
				} // end foreach
				$companies_data['create'] = $temp_companies_data_create;

				$auctionordernumins = AuctionOrderNum::where(['order_uid' => $order->uid ] )->first();
				if( $auctionordernumins) {
					$auctionordernumins->update( $auctionordernumdata);
				}
				else {
					$ins = AuctionOrderNum::create( $auctionordernumdata );
				}
				//오더 플래그 변경
				/*
				$order->share_status = 'DONE';
				$order->auto_share = 'N';
				$order->share_price = $discount_price;
				$order->contact_name = '';
				$order->order_path = '2';
				//todo $order->save();
				*/
				$data['share_status']='DONE';
				$data['auto_share']='N';
				$data['share_price']=$discount_price;
				$data['contact_name']='';
				$data['order_path']='2';
			} // END 직접선택

			//추천받기
			else {
				/*
				$order->contact_name = '';
				$order->order_path = '1';
				$order->save();
				*/
				$data['contact_name']='';
				$data['order_path']='1';
			}

			$order->update($data);

			\DB::commit();
			//\DB::rollback();
		}catch( Exception $e){
			\DB::rollback();
			return $this->error( $e->getMessage() );
		}

		// 종료후 문자발송
		$res_companies =[];

		try{
			if( $data['contact_list_recommend'] == 'selection' ){
				$modoo24Name = '모두이사';
				//문자발송 고객
				$sms_title = '안녕하세요 '.$modoo24Name.' 입니다.';
				$sms_ment = "안녕하세요.".$data['name']." 고객님.\n".$modoo24Name." 입니다.\n".$modoo24Name."를 이용해주셔서 감사합니다.\n선정된 업체 정보는 아래와 같습니다.\n";
				foreach( $companies_data['create'] as $row ){
					$sms_ment .= "[".$row['s_company']."] ".$row['hp']."\n";
				}
				$enc_orderid = base64_encode($order->uid);

				$sms_ment .= ":: 업체정보 확인 url ::\nhttps://modoo24.net/v1/review/cp_view?cmd=cp_list&v=Y&code=".$enc_orderid;
				$sms_ment .= $this->eventMessage;

				$sms_res = $this->sms( preg_replace('/[^0-9]/', '',$data['hp']),$sms_title, $sms_ment);


				//문자발송, 푸쉬발송 회사  $companies_data['create'] loop

				$sms_staff = $modoo24Name." 입니다.\n";
				$sms_staff .= $data['mdate']."\n"; // 이사일
				$sms_staff .= $data['name']." 고객님\n"; // 고객명
				$sms_staff .= "연락처: ".$data['hp']."\n"; // 연락처
				$sms_staff .= "[".$_stype." 이사]\n"; // 이사종류
				$sms_staff .= "출발지: ".$data['s_addr1'].' '.$data['s_addr2']."\n"; // 출발지
				$sms_staff .= "도착지: ".$data['e_addr1']."\n"; // 도착지

				$push_staff_user_arr = [];
				foreach($companies_data['create'] as $row){
					$this->sms( preg_replace('/[^0-9]/', '',$row['hp'] ),$sms_title, $sms_staff);
					$push_staff_user_arr[] = $row['s_uid'];

					//return 용 데이터
					$res_companies[]=[
						's_uid'=>$row['s_uid']
						, 's_company'=>$row['s_company']
					];

				}
				$this->makeOneSignal($push_staff_user_arr, '모두플랫폼 오더안내', $sms_staff,'','http://24auction.co.kr/m/order/counsel?status=ALL');

			} // end  $data['contact_list_recommend'] == 'selection'
			//문자보내기 -추천받기
			else {
				$subject = '모두이사 입니다.';
				$msg = '[모두이사 방문견적 신청완료]'."\n";

				$msg .= '안녕하세요. '.$order->name.' 고객님, 모두이사입니다.'."\n";
				$msg .= '이사 견적 신청이 완료되었습니다.'."\n\n";
				$msg .= '이사일 : '.$order->mdate.''."\n";
				$msg .= '출발지 주소 : '.$order->s_addr1.' '.$order->s_addr2."\n";
				$msg .= '도착지 주소 : '.$order->e_addr1.''."\n\n";
				$msg .= '원활한 이사 견적 진행을 위해'."\n";
				$msg .= '상담을 통해 이사업체를 추천드립니다.'."\n";
				$msg .= '잠시만 기다려주세요.'."\n\n";
				$msg .= '고객센터 운영시간 이후에 접수된 이사 건은 익일 오전 09시부터 처리될 수 있습니다.'."\n";
				$msg .= '감사합니다.'."\n\n";
				$msg .= '고객센터 1600-7728'."\n";
				$msg .= '평일 : 오전 09시 ~ 오후 06시 30분'."\n";
				$msg .= '공휴일, 주말 : 오전 09시 ~ 오후 05시';
				$msg.= $this->eventMessage;
				$sms_res = $this->sms( preg_replace('/[^0-9]/', '',$data['hp']),$subject, $msg);
			}
		}catch (\Exception $e){
			;
		}
		try{
			$cleandata = AuctionCleanOrder::where(['s_with2'=>1, 'order_uid'=>$order->uid])->first();

			if( !$cleandata ) {
				$clean=[
					'contact_name'=>'',
					'order_path'=>'1',//온라인
					's_uid'=>'0',
					's_with2'=>'1',//방문
					's_with3'=>'0',
					's_with4'=>'0',
					'mdate'=>$order->mdate,
					'company'=>'',
					'name'=>$order->name,
					'passwd'=>'',
					'hp'=>$order->hp,
					'stype'=>'1',//입주청소
					's_addr1'=>$order->e_addr1,
					's_addr2'=>'',
					'note'=>'',
					'user_memo'=>'테스트중입니다 분배하지말아주세요',
					'memo'=>'',
					'com_num'=>'0',
					'reg_date'=>Carbon::now()->format('Y-m-d H:i:s'),
					'aircon_yn'=>'Y',//우선은 있는것으로
					'type'=>'',//주거종류 선택없음
					'share_status'=>'ING',
					'clean_staff_cnt'=>'0',
					'clean_elevator'=>'N',
					'clean_addr_pyoung'=>'',
					'order_uid'=>$order->uid,
				];
				$cleanins = AuctionCleanOrder::create($clean);
			}else {
				$clean=[
					'mdate'=>$order->mdate,
					'name'=>$order->name,
					'hp'=>$order->hp,
					's_addr1'=>$order->e_addr1,
				];
				$cleandata->update( $clean);
			}

		}catch(\Exception $e){
			;
		}

		$res_data = [
			'stype' =>$_stype,
			'mdate' =>$order->mdate,
			'name' =>$order->name,
			'hp' =>$order->hp,
			'depatures' =>$order->s_addr1.' '.$order->s_addr2,
			'arrivals' =>$order->e_addr1,
			'companies'=>$res_companies
		];
		return $this->success($res_data);
	}


	private function makeCompanys($request){
		$ret = [];
		$company = $request->company;
		$staffs = AuctionStaff::whereIn( 's_uid', $company)->inRandomOrder()->get();

		$n = 1;
		foreach( $staffs as $row){
			$ret['s_uid'.$n] = $row->s_uid;
			$ret['s_id'.$n] = $row->s_id;
			$ret['s_company'.$n] = $row->s_company;
			$ret['s_give_date'.$n] = $this->now;

			$ret['create'][] = [
				'assign_sort'=>$n,
				's_uid'=>$row->s_uid,
				's_id'=>$row->s_id,
				's_company'=>$row->s_company,
				's_give_date'=>$this->now,
			];
			$ret['now_date'] = $this->now;
			++$n;
		}
		return $ret;
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
		 $mdateCarbon =  Carbon::createFromFormat('Y-m-d',$request->mdate);
		 $diff_day = $mdateCarbon->diffInDays( Carbon::now() );
		 if( $diff_day > 90 ) return "이사 날짜는 최대 90일 안으로 선택하셔야 합니다.";
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
