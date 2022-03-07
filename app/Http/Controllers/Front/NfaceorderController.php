<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Libraries\MobileDetect;

use App\User;

use App\Models\BulletinSidoCopy;
use App\Models\LaravelTraceLog;

/* TODO */
use App\Models\AuctionOrderNface;
use App\Models\AuctionCleanOrder;

class NfaceorderController extends Controller
{
	use ApiResponser;
	/* 도착지 출발지 체크 */

	function makelog(Request $request, $code, $step, $substep=null, $tranceval = null ){
		$exceptIp = ['221.154.134.3'];

		/* TODO 내부 IP제외 */
		//if( in_array($request->ip(), $exceptIp)) return $this->error('EXCEPT IP');

		$unique_limit = 10;

		$logUnique = $request->session()->get('traceLogId', function () use ($request) {
			$unique = $this->getUniqueString(10);
			$request->session()->put('traceLogId', $unique);
		  return $unique;
		});
		if( in_array($step ,['open','start','1','step1']) ){
			$request->session()->forget('traceOpenId');
		}
		$logOpenId = $request->session()->get('traceOpenId', function () use ($request) {
			$unique = $this->getUniqueString(10);
			$request->session()->put('traceOpenId', $unique);
		  return $unique;
		});

		$agent = new MobileDetect();
 		$mobileResult = $agent->isMobile();
		try{
			$lastlog = LaravelTraceLog::where(['openId'=>$logOpenId])->first();
			if( !$lastlog){
				LaravelTraceLog::create([
					"uniqueId"=>$logUnique,
					"openId"=>$logOpenId,
					"isMobile"=> $mobileResult ? 'Y':'N',
					"page"=>$code,
					"step"=>$step,
					"substep"=>$substep,
					"ip"=>$request->ip()
				]);
			}else {
				if($lastlog->step <= $step && $lastlog->tranceval <= $tranceval){
					$lastlog->step= $step;
					$lastlog->tranceval= $tranceval;
					$lastlog->substep= $substep;
					$lastlog->save();
				}
			}
		} catch( \Exception $e ){
			return $this->error($e->getMessage());
		}
		return $this->success();
	}
	function stepcheck(Request $request){
		return $this->error("잘못된 데이터 입니다",500);
		if($request->step == 1) return $this->step1( $request);
		else if ($request->step == 2) return $this->step2( $request);
		else if ($request->step == 3) return $this->step3( $request);
		else if ($request->step == 4) return $this->step4( $request);
		else if ($request->step == 5) return $this->complete( $request);
		else return $this->error("잘못된 데이터 입니다");
	}

	private function onesignalpush($auction_order_nface_uid){
		$order = AuctionOrderNface::find($auction_order_nface_uid);

		$sido = trim($order->sido);
		$gugun = trim($order->gugun);
		$sidogugun = $sido .' '.$gugun;
		$push_move_date = $order->m_date;

		$sql = "SELECT a.s_uid,a.s_id, a.app_push_id
		FROM auction_staff a
		left join auction_close b on a.s_uid = b.s_uid and b.now_date = '".$push_move_date."'

		WHERE
			s_share_flag = 'Y'
			AND instr(s_city, '" .$sidogugun. "') > 0
			AND (
				s_classify4 = '1' OR s_classify5 = '1'
				OR s_classify6 = '1' OR s_classify7 = '1')
			AND
				(
					b.close is null or b.close = '0'
				)
			AND app_push_id != ''
			#and s_id in('modoo','0003')
			";

 		$data =  \DB::select( $sql);
		if( empty($data)) return ;
		$appids = [];

		foreach( $data as $row) $appids[] = $row->app_push_id;
		$this->sendOneSignal($appids, "[".$sidogugun."] 비대면 오더가 도착했습니다","사장님! 지금 바로 선착순 이사 견적을 넣으세요.");
	}
	function step1(Request $request){
		/*step1 check */
		$res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*end step1 check */
		$this->makelog($request, 'nfacepop', '2' );
    return $this->success( );
  }
	function step2(Request $request){
    $res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*step2 check */
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);
		$tempdata = $request->all();
		$this->makelog($request, 'nfacepop', '3' , $tempdata['moving-goods-method'] );
    return $this->success(['command'=>'changeNfaceGoodsMethod'] );
  }
	function step3(Request $request){
		$res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*step2 check */
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);

		$goods = $this->stepGoodsLsitCheck($request);
		if( !is_array($goods) ) return $this->error($res,422,['step'=>3]);
		if( count( $goods) < 1 ){
			return $this->error('옮기실 짐들을 선택해주세요.',422,['step'=>3]);
		}
		$tempdata = $request->all();
		$this->makelog($request, 'nfacepop', '4', $tempdata['moving-goods-method']  );
		return $this->success(['command'=>'changeNfaceGoodsMethod'] );
	}
	function step4(Request $request){
		$res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*step2 check */
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);

		$goods = $this->stepGoodsLsitCheck($request);
		if( !is_array($goods) ) return $this->error($res,422,['step'=>3]);
		$tempdata = $request->all();
		if( $tempdata['moving-goods-method'] !='picture' && count( $goods) < 1 ){
			return $this->error('옮기실 짐들을 선택해주세요.',422,['step'=>3]);
		}
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>4, 'data'=> $this->errors]);


		$this->makelog($request, 'nfacepop', '5', $tempdata['moving-goods-method']  );
		return $this->success(['command'=>'changeNfaceGoodsMethod'] );
	}
	function step1_(Request $request){
		/*step1 check */
    $res = $this->stepAddressCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1, 'data'=> $this->errors]);
		/*end step1 check */
		$this->makelog($request, 'nfacepop', '2' );
    return $this->success( );
  }
	/* 이사일 체크 */
	function step2_(Request $request){
		/*step1 check */
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1, 'data'=> $this->errors]);
		/*step2 check */
    $res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>2]);

		$this->makelog($request, 'nfacepop', '3' );
    return $this->success( );
  }
	/* 이사종류 & 이삿짐량 선택 */
	function step3_(Request $request){
		/*step1 check */
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1, 'data'=> $this->errors]);
		/*step2 check */
    $res = $this->stepMdateCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>2]);
		/*step2 check */
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>3]);
		$tempdata = $request->all();
		$this->makelog($request, 'nfacepop', '4' , $tempdata['moving-goods-method'] );
    return $this->success(['command'=>'changeNfaceGoodsMethod'] );
  }
	/* 짐량확인 */
	function step4_(Request $request){
		/*step1 check */
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1, 'data'=> $this->errors]);
		/*step2 check */
		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);
		/*step2 check */
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>3]);

		$goods = $this->stepGoodsLsitCheck($request);
		if( !is_array($goods) ) return $this->error($res,422,['step'=>4]);
		if( count( $goods) < 1 ){
			return $this->error('옮기실 짐들을 선택해주세요.',422,['step'=>4]);
		}
		$tempdata = $request->all();
		$this->makelog($request, 'nfacepop', '5', $tempdata['moving-goods-method']  );
		return $this->success(['command'=>'changeNfaceGoodsMethod'] );
	}
	function complete(Request $request){

		/*step1 check */
		//$res = $this->stepAddressCheck($request);
		//if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*step2 check */
		//$res = $this->stepMdateCheck($request);
		//if( $res !== true) return $this->error($res,422,['step'=>2]);
		/*step3 check */
		//$res = $this->stepCarryingMethodCheck($request);
		//if( $res !== true) return $this->error($res,422,['step'=>3]);

		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1]);
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);

		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>4, 'data'=> $this->errors]);

		/*step5 check */
		$res = $this->stepUserDataCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>5, 'data'=> $this->errors]);



		$data = $request->except(['upload','goods']);
		$data = array_merge( $data , $this->tranceData($data));

		$uploadefiles = [];

		/*step4 check */
		if( $data['moving-goods-method'] =='list' ){

			$goods = $this->stepGoodsLsitCheck($request);
			if( !is_array($goods) ) return $this->error($res,422,['step'=>3]);

			if(count( $goods) < 1) return $this->error('옮기실 짐들을 선택해주세요.',422,['step'=>3]);
			$data['goods'] = $goods;
		}else {
			$data['goods'] = null;
			if( $request->agree_ai != 'Y'){
				return $this->error('AI 이용에 동의해주세요.',422,['step'=>3]);
			}
			$files = $request->file('upload');

			if($request->hasFile("upload")){
					//foreach ($files as $file) {
					foreach($files as $file){
						$uploadres = $this->uploadImage( $file );
						if( $uploadres != null ) $uploadefiles[] = $uploadres;
					}
			}
		}
		$data['images'] = $uploadefiles;

		$create = $this->create( $data);
		if( $create===true ){

			/* TODO */
			//sleep(1);
			$this->createCompleted($data);
			$tempdata = $request->all();
			$this->makelog($request, 'nfacepop', '6', $tempdata['moving-goods-method'],'4000'  );
			return $this->success();
		}else return $this->error($create);
	}

	private function create( $data ){
		\DB::beginTransaction();
		try{
			$startAddr = $this->getAddressInfo( $data['s_bcode'] );
			$movingtype = $this->getClassifyType( $data['movingmethod']);

			$trance = [
				'order_path'=>1,
				's_uid' => (isset($data['internet_call']) && $data['internet_call']=='Y') ? '1':'0', //인터넷
				's_with2' => ($data['movingtype'] == 'small' && isset($data['s_help_no']) && $data['s_help_no']=='Y') ? '1':'0',//도와줄수있나요
				'sido'=>$startAddr['sido'],
				'gugun'=>$startAddr['gu'],
				'mdate'=>$data['mdate'],
				'name'=>$data['register_name'],
				'passwd'=>(isset($data['agree_marketing']) && $data['agree_marketing']=='Y') ? 'Y':'N', //인터넷
				'hp'=>$data['register_phone'],
				'vn'=>$data['s_bcode'],
				'classify'=>$this->getClassify( $data['movingtype']), // 이사종류(소형,가정..)
				'stype'=>$movingtype['stype'], //이사 타입 (포장..)
				's_zip1'=>$data['s_zip1'],
				's_addr1'=>$data['s_addr1'],
				's_addr2'=>$data['s_addr2'],
				's_area'=>$data['s_pyeong'],
				's_floor'=>$data['s_floor'],
				's_el'=>$data['s_ev_no'],
				's_park'=>$data['s_park_no'],
				'e_zip1'=>$data['e_zip1'],
				'e_addr1'=>$data['e_addr1'],
				'e_area'=>$data['e_pyeong'],
				'e_floor'=>$data['e_floor'],
				'e_el'=>$data['e_ev_no'],
				'e_park'=>$data['e_park_no'],
				'goods'=>$data['goods'],
				'note'=>( isset($data['memo']) ) ? $data['memo'] : '',
				'img_files'=>$data['images'],
				'keep'=>(isset($data['use_container']) && $data['use_container']=='Y') ? 'Y':'N', //$data['use_container'], //보관
				'type'=>$movingtype['type'],
				'clean_yn'=>(isset($data['use_clean']) && $data['use_clean']=='Y') ? 'Y':'N',
				's_check_type'=>($data['moving-goods-method'] =='list') ? 'box':'pic',
				'user_memo'=>'',
				'selck'=>'',
				'share_status'=>'ing',
				'reg_company_type'=>'모두이사',
				'cafe_name'=>'모두이사_official_untact2'
			];

			$ins = AuctionOrderNface::create($trance);
			/*입주청소*/
			if( isset($data['use_clean']) && $data['use_clean']=='Y'){
				$clean=[
					'contact_name'=>'',
					'order_path'=>'1',//온라인
					's_uid'=>'0',
					's_with2'=>'2',//비대면
					's_with3'=>'0',
					's_with4'=>'0',
					'mdate'=>$data['mdate'],
					'company'=>'',
					'name'=>$data['register_name'],
					'passwd'=>'',
					'hp'=>$this->format_tel($data['register_phone']),
					'stype'=>'1',//입주청소
					's_addr1'=>$data['e_addr1'],
					's_addr2'=>'',
					'note'=>'',
					'user_memo'=>'',
					'memo'=>'',
					'com_num'=>'0',
					'reg_date'=>Carbon::now()->format('Y-m-d H:i:s'),
					'aircon_yn'=>'Y',//우선은 있는것으로
					'type'=>'',//주거종류 선택없음
					'share_status'=>'ING',
					'clean_staff_cnt'=>'0',
					'clean_elevator'=>$data['e_ev_no'],
					'clean_addr_pyoung'=>$data['e_pyeong'],
					'order_uid'=>"1",
				];
				$cleanins = AuctionCleanOrder::create($clean);
			}
			\DB::commit();
		} catch( \Exception $e){
			\DB::rollback();
			return $e->getMessage();
		}
		$this->onesignalpush($ins->uid);
		return true;
	}
	private function createCompleted($data){
		$message = "[모두이사 비대면 견적 신청완료]
안녕하세요. ".$data['register_name']." 고객님, 모두이사입니다.
비대면 이사 견적 신청이 완료되었습니다.

▶이사일 : ".$data['mdate']."
▶ 출발지 주소 : ".$data['s_addr1']." ".$data['s_addr2']."
▶ 도착지 주소 : ".$data['e_addr1']."

최대 10개 이사업체의 이사 견적을 보내드립니다.
감사합니다.
☎ 고객센터 1600-7728
평일 : 오전 9시 ~ 오후 6시 30분
공휴일, 주말 : 오전 9시 ~ 오후 5시

---------------

★모두이사 칭찬후기 이벤트★
모두이사 매칭업체 이사서비스를 받으시고 칭찬후기를 작성해주세요
작성해주신 모든 고객님께 커피쿠폰을 드립니다.
업체평가하기 -> http://modoo24.net/v2/review/my";
		$this-> sms($data['register_phone'], '비대면견적신청완료', $message);
	}
	/* 변환 */
	//시도 , 구군
	private function getAddressInfo( $bcode){
		$dongcode = substr($bcode, 0,8);
		$data = BulletinSidoCopy::where(['dong_code'=>$dongcode])->first();
		if( $data->si_code =='36'){
			return ['sido'=> '세종', 'gu'=>$data->dong];
		}else {
			$origin_sido = ['서울시','경기도','인천시','부산시','대전시','대구시','울산시','세종시','광주시','강원도','충청북도','충청남도','경상북도','경상남도','전라북도','전라남도','제주도'];
			$replace_sido = ['서울','경기','인천','부산','대전','대구','울산','세종','광주','강원','충북','충남','경북','경남','전북','전남','제주'];

			return ['sido'=> $res = str_replace( $origin_sido, $replace_sido , $data->sido ), 'gu'=>$data->gu];
		}
	}
	//이사종류
	private function getClassify( $movingtype){
		switch($movingtype){
			case "small" :
				return 1;
			case "home" :
				return 2;
			case "office" :
				return 3;
			default :
				return '0';
		}
	}
	//이사 타입
	private function getClassifyType( $movingmethod){
		switch($movingmethod){
			case "packaging" :
				return ['stype'=>'2', 'type'=>'포장'];
			case "half-packaging" :
				return ['stype'=>'7', 'type'=>'반포장'];
			case "carrying" :
				return ['stype'=>'1', 'type'=>'일반'];
			default :
				return ['stype'=>'0', 'type'=>'선택'];
		}
	}
	/* end 변환 */

	/* step 1 */
  private function stepAddressCheck(Request $request ){
		$this->errors = null;
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
		 if ($validator->fails()) { $this->errors = $validator->errors(); return $validator->messages()->first();}
		 else return true;
  }
	/* step 2 */
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
	/* step 3 */
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
	/* step 4 */
	private function stepGoodsLsitCheck(Request $request){
		$messages = [
				'memo.*'=>'메모를 확인해주세요',
				'moving-goods-method.*'=>'짐량 확인 방법을 선택해주세요'
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'memo'=>'bail|nullable|string',
			'moving-goods-method'=>'bail|required|in:list,picture'
		 ],$messages);
		 if ($validator->fails()) return $validator->messages()->first();

		$goods = [];
		foreach ( $request->goods as $idx=>$val){
			if ( (int)$val > 0 ) {
				$tmp = explode("_", $idx);
				if( count($tmp) == 2 ){
					$goods[$tmp[0]][$tmp[1]] = $val;
				}else {
					$goods[$tmp[0]] = $val;
				}
			}
		}
		return $goods;
	}
	/* step 5 */
	private function stepUserDataCheck(Request $request){
		$messages = [
				'register_name.*'=>'신청인 이름을 적어주세요',
				'register_phone.*'=>'신청인 전화번호를 적어주세요',
				'agree1.*'=>'[이용약관 및 개인정보처리방침] 에 동의해주세요',
				'agree2.*'=>'[제 3 자 제공] 에 동의해주세요',
				'agree_marketing.*'=>'마케팅 동의를 확인해주세요',
		];
		//$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
			'register_name'=>'bail|required|string|min:2',
			'register_phone'=>'bail|required|digits_between:9,13',
			'agree1'=>'bail|required|in:Y,on',
			'agree2'=>'bail|required|in:Y,on',
			'agree_marketing'=>'bail|nullable|in:Y,on',
		 ],$messages);
		 if ($validator->fails()) return $validator->messages()->first();
		 return true;
	}


	private function tranceData($data){
		$checkoption = ['s_ev_no', 's_park_no','e_ev_no', 'e_park_no','use_clean','internet_call','s_help_no','agree3'];
		foreach ( $checkoption as $opt){
			$data[$opt] = ( !isset($data[$opt]) ||  !in_array($data[$opt], ['Y','on']) ) ? 'N': 'Y';
		}
		return $data;
	}



	private function getGroupNumFromName($name){
		$tmp = explode('_', $name);
		$groupnum = 0;
		if( count($tmp) > 1 ){
				$groupnum = array_shift($tmp);
				$name= pathinfo( implode('_', $tmp) , PATHINFO_FILENAME);
		}
		return ['groupnum'=>$groupnum, "name"=>$name];
	}
	private function uploadImage( UploadedFile $file = null, $id = null)
    {
        if ($file === null) return null;

				try{
	        $storage = Storage::disk('public');
	        $path = 'order/nface/'.Carbon::now()->format('ymd').'/';
					$gropuname = $this->getGroupNumFromName( $file->getClientOriginalName() );

					$origin = $gropuname['name'] ;
					$groupname = $gropuname['groupnum'] ;

	        $image = Image::make($file);

					$ext = $file->getClientOriginalExtension();
					$image_name = Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $ext;

	        if (!$storage->exists($path)) {
	            $storage->makeDirectory($path, 0775, true);
	        }
					if (!$storage->exists('thumb/'.$path)) {
	            $storage->makeDirectory($path, 0775, true);
	        }
	        $storage->put($path . $image_name, $image->stream()->__toString());
					/*
					$image->resize('200', null, function ($constraint) {
							$constraint->aspectRatio();
					});
					$storage->put('thumb/'.$path . $image_name, $image->stream()->__toString());
					*/
					$size=  $file->getSize();
					$url = '/'.$path . $image_name;
					return [
						'nfaceorder_id'=>$id,
						'original_name'=> $origin,
						'url'=>$url,
						'groupname'=>$groupname,
					];
				}catch( \Exception $e) {
					dump( $e->getMessage() );
					return null;
				}
        //return $path . $image_name;
    }
		private function format_tel($tel) {
    $tel = preg_replace('/[^0-9]/', '', $tel);
	    return preg_replace('/(^02.{0}|^01.{1}|^15.{2}|^16.{2}|^18.{2}|[0-9]{3})([0-9]+)([0-9]{4})/', '$1-$2-$3', $tel);
		}
}
/*

array:35 [
  "s_bcode" => "3011010700"
  "s_sigunguCode" => "30110"
  "s_jibun_addr1" => null
  "s_zip1" => "34672"
  "s_addr1" => "대전 동구 판암동 502-5"
  "s_addr2" => "2"
  "s_pyeong" => "3"
  "s_floor" => "1"
  "s_ev_no" => "Y"
  "s_park_no" => "Y"
  "e_bcode" => "4167025040"
  "e_sigunguCode" => "41670"
  "e_jibun_addr1" => null
  "e_zip1" => "12660"
  "e_addr1" => "경기 여주시 가남읍 삼평길 11"
  "e_pyeong" => "15"
  "e_floor" => "5"
  "e_ev_no" => "Y"
  "e_park_no" => "Y"
  "use_clean" => "Y"
  "use_container" => "Y"
  "mdate" => "2022-01-13"
  "movingtype" => "small"
  "movingmethod" => "carrying"
  "moving-goods-method" => "picture"
  "memo" => null
  "register_name" => "한글"
  "register_phone" => "0101111111"
  "agree1" => "Y"
  "agree2" => "Y"
  "internet_call" => "N"
  "s_help_no" => "N"
  "agree3" => "N"
  "goods" => null
  "images" => array:6 [
    0 => array:4 [
      "nfaceorder_id" => null
      "original_name" => "KakaoTalk_20210312_144653143.jpg"
      "url" => "/order/nface/220112/220112013026_FR6rXjUYD.jpg"
      "groupname" => "1"
    ]
    1 => array:4 [
      "nfaceorder_id" => null
      "original_name" => "KakaoTalk_20210312_144653143_01.jpg"
      "url" => "/order/nface/220112/220112013026_tw6kmPdXl.jpg"
      "groupname" => "1"
    ]
    2 => array:4 [
      "nfaceorder_id" => null
      "original_name" => "KakaoTalk_20210312_144653143_02.jpg"
      "url" => "/order/nface/220112/220112013026_2jWQWMEeE.jpg"
      "groupname" => "1"
    ]
    3 => array:4 [
      "nfaceorder_id" => null
      "original_name" => "KakaoTalk_20210312_144653143_03.jpg"
      "url" => "/order/nface/220112/220112013026_9mdhrUoqL.jpg"
      "groupname" => "1"
    ]
    4 => array:4 [
      "nfaceorder_id" => null
      "original_name" => "KakaoTalk_20210312_144653143_04.jpg"
      "url" => "/order/nface/220112/220112013026_arOZeCSFU.jpg"
      "groupname" => "1"
    ]
    5 => array:4 [
      "nfaceorder_id" => null
      "original_name" => "KakaoTalk_20210312_144653143_05.jpg"
      "url" => "/order/nface/220112/220112013026_2JbIrzf5s.jpg"
      "groupname" => "1"
    ]
  ]
]

*/
