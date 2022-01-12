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

use App\User;

use App\Models\BulletinSidoCopy;
use App\Models\AuctionOrderNfaceTest;
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
		if( $res !== true) return $this->error($res,422,['step'=>3]);

    return $this->success(['command'=>'changeNfaceGoodsMethod'] );
  }
	/* 짐량확인 */
	function step4(Request $request){
		/*step1 check */
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1]);
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

		return $this->success(['command'=>'changeNfaceGoodsMethod'] );
	}
	function complete(Request $request){
		/*step1 check */
		$res = $this->stepAddressCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*step2 check */
		$res = $this->stepMdateCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>2]);
		/*step3 check */
		$res = $this->stepCarryingMethodCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>3]);
		/*step3 check */
		$goods = $this->stepGoodsLsitCheck($request);
		if( !is_array($goods) ) return $this->error($res,422,['step'=>4]);
		/*step5 check */
		$res = $this->stepUserDataCheck($request);
		if( $res !== true) return $this->error($res,422,['step'=>5]);



		$data = $request->except(['upload','goods']);
		$data = array_merge( $data , $this->tranceData($data));
		$uploadefiles = [];

		if( $data['moving-goods-method'] =='list' ){
			if(count( $goods) < 1) return $this->error('옮기실 짐들을 선택해주세요.',422,['step'=>4]);
			$data['goods'] = $goods;
		}else {
			$data['goods'] = null;

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
		$this->create( $data);

	}
	private function create( $data ){
		$startAddr = $this->getAddressInfo( $data['s_bcode'] );
		$movingtype = $this->getClassifyType( $data['movingmethod']);

		$trance = [
			'order_path'=>1,
			's_uid' => (isset($data['internet_call']) && $data['internet_call']=='Y') ? '1':'0', //인터넷
			's_with2' => (isset($data['s_help_no']) && $data['s_help_no']=='Y') ? '1':'0',//도와줄수있나요
			'sido'=>$startAddr['sido'],
			'gugun'=>$startAddr['gu'],
			'mdate'=>$data['mdate'],
			'name'=>$data['register_name'],
			'passwd'=>(isset($data['agree_marketing']) && $data['agree_marketing']=='Y') ? 'Y':'N', //인터넷
			'hp'=>$data['register_phone'],
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
		$ins = AuctionOrderNfaceTest::create($trance);

		dump( $trance);
		dd($data);
		dump( $ins);
	}
	/* 변환 */
	//시도 , 구군
	private function getAddressInfo( $bcode){
		$dongcode = substr($bcode, 0,8);
		$data = BulletinSidoCopy::where(['dong_code'=>$dongcode])->first();
		if( $data->si_code =='36'){
			return ['sido'=> $data->gu, 'gu'=>$data->dong];
		}else {
			return ['sido'=> $data->sido, 'gu'=>$data->gu];
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
