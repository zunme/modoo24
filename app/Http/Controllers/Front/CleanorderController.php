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

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
//use Illuminate\Support\Facades\Redis;

use App\Models\NewCleanOrder;

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
		if( $request->nooption=='Y') {
			$this->data['options'] = ['옵션없음'];
			return true;
		}else {
			$messages = [
				'options.*' =>'청소옵션를 선택해주세요',
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
		$spaceArr = ['room'=>'방','toilet'=>'화장실','veranda'=>'베란다'];
		foreach( $spaceArr as $space_id=>$space_val){
			if( $request->{ $space_id.'_except'} =='Y') {
				$this->data[$space_id.'_num'] = '0';
				$data['num'][$space_val]=false;
			}else {
				$messages = [
					$space_id.'_num.*' =>$space_val.'갯수를 선택해주세요',
				];
				//$data = $this->validate($request, [
				$validator = Validator::make($request->all(),[
					$space_id.'_num' => 'bail|required||integer|min:1|digits_between: 1,99',
				 ],$messages);
				if ($validator->fails()) return $validator;
				$data['num'][$space_val] = $request->{$space_id.'_num'};
			}
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
			return [$this->spacetypes[$type]=>'청소안함'];
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

	private function stepUserDataCheck(Request $request ){
		$this->errors = null;
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
		 if ($validator->fails()) return $validator;
		 else return true;
	}

	public function stepComplete(Request $request){
		$spacenums=[];
		foreach ( $this->spacetypes as $type=>$val){
			$res = $this->checkSpaceNum($request, $type);
			if ( !is_array( $res ) ) return $this->error($res->messages()->first() ,422,['step'=>5, 'data'=> $res->errors() ]);
			$spacenums[] = $res;
		}

		$this->data = $request->except('upload');
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
		$res = $this->stepUserDataCheck($request);
		if( $res !== true) {
			return $this->error($res->messages()->first() ,422,['step'=>6, 'data'=> $res->errors() ]);
		}

		$this->data['spacenums'] = $spacenums;


		$uploadefiles = [];
		if($request->hasFile("upload")){
			 //foreach ($files as $file) {
		 $files = $request->file('upload');
			 foreach($files as $file){
					try{
						$uploadres = $this->uploadImage( $file );
						if( $uploadres != null ) $uploadefiles[] = $uploadres;
					}catch (\Exception $e){
						;
					}
			 }
		}
		$this->data['files'] = $uploadefiles;
		//Redis::publish('test-channel', json_encode($this->data));
		try{
			NewCleanOrder::create($this->data);
		}catch(\Exception $e){
			return $this->error($e->getMessage(),500);
		}

		return $this->success(  $this->data );
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
	private function uploadImage( UploadedFile $file = null, $id = null){
			if ($file === null) return null;

			try{
				$storage = Storage::disk('public');
				$path = 'order/clean/'.Carbon::now()->format('ymd').'/';
				$gropuname = $this->getGroupNumFromName( $file->getClientOriginalName() );

				$origin = $gropuname['name'] ;
				$groupname = $gropuname['groupnum'] ;

				$image = Image::make($file);

				$ext = $file->getClientOriginalExtension();
				$image_name = Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $ext;

				if (!$storage->exists($path)) {
						$storage->makeDirectory($path, 0775, true);
				}
				$storage->put($path . $image_name, $image->stream()->__toString());
				$size=  $file->getSize();
				$url = 'storage/'.$path . $image_name;
				return [
					'original_name'=> $origin,
					'url'=>$url,
				];
			}catch( \Exception $e) {
				return null;
			}
			//return $path . $image_name;
	}

}
