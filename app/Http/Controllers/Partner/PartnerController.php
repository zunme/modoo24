<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AuctionStaff;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Validator;
use App\Traits\ApiResponser;


class PartnerController extends Controller
{
	use ApiResponser;

	// 업체 정보 추출
	public function index(Request $request){

		session_start();
		$session =  $_SESSION;
		session_write_close();

		$staff = AuctionStaff::find($session['idx']);
		//$staff = AuctionStaff::find($request->id);

		if ( $staff->flat_rate_staff == 'Y' ) {
			$staff_type_str = '방문 정액제';
		} else if ( $staff->flat_rate_staff == 'N'){
			if ( $staff->classify1 == "1" || $staff->classify2 == "1" || $staff->classify3 == "1" )  {
				$staff_type_str = '방문 일반제';
			} else {
				$staff_type_str = '비대면 일반제';
			}
		}

		if( is_array($staff->s_mobile_img0) ){

			$regfiles = [
				"title_img"=>(isset($staff->s_mobile_img0[0]) )  ? $staff->s_mobile_img0[0] : null,
				"사업자등록증"=> is_object($staff->s_mobile_img1) ? $staff->s_mobile_img1 : ( isset($staff->s_mobile_img1) && is_array($staff->s_mobile_img1) && count($staff->s_mobile_img1)>0  ? $staff->s_mobile_img1[0] : null ),
				"주선허가증"=>is_object($staff->s_mobile_img2) ? $staff->s_mobile_img2 : ( isset($staff->s_mobile_img2) && is_array($staff->s_mobile_img2) && count($staff->s_mobile_img2)>0  ? $staff->s_mobile_img2[0] : null )

			];

		}else {
			$regfiles = '';

		}

		$subfiles = [
			is_object($staff->s_mobile_img3_1) ? $staff->s_mobile_img3_1 : ( isset($staff->s_mobile_img3_1) && is_array($staff->s_mobile_img3_1) && count($staff->s_mobile_img3_1)>0  ? $staff->s_mobile_img3_1[0] : null ),
			is_object($staff->s_mobile_img3_2) ? $staff->s_mobile_img3_2 : ( isset($staff->s_mobile_img3_2) && is_array($staff->s_mobile_img3_2) && count($staff->s_mobile_img3_2)>0  ? $staff->s_mobile_img3_2[0] : null ),
			is_object($staff->s_mobile_img3_3) ? $staff->s_mobile_img3_3 : ( isset($staff->s_mobile_img3_3) && is_array($staff->s_mobile_img3_3) && count($staff->s_mobile_img3_3)>0  ? $staff->s_mobile_img3_3[0] : null ),
			is_object($staff->s_mobile_img3_4) ? $staff->s_mobile_img3_4 : ( isset($staff->s_mobile_img3_4) && is_array($staff->s_mobile_img3_4) && count($staff->s_mobile_img3_4)>0  ? $staff->s_mobile_img3_4[0] : null )
		];

		$totalImgCount = count(array_filter($subfiles));

		//dd($subfiles);
		$pay_ment = [];
		$pay_ment = explode('|', $staff->s_payment);

		//dd($totalImgCount);
		$p_ip = $_SERVER['REMOTE_ADDR'];

		return view("/Partner/main" , compact(['staff','staff_type_str', 'regfiles', 'subfiles', 'pay_ment', 'p_ip','totalImgCount']) );
	}

	// 업체 정보 변경
	public function modifyPrc(Request $request){

		session_start();
		$session =  $_SESSION;
		session_write_close();


		if (!isset($session['idx']) ) {
			// 아이디가 존재 하지 않을경우
			return $this->error('정보가 존재 하지 않습니다.',422);
		}

		$messages = [
			's_uid.*' => '업체 정보가 필요합니다.',
			's_ceo_name.*' =>'대표자명을 입력해주세요.',
			's_addr1.*' =>'주소를 입력해주세요.',
			's_ceo_hp.*' =>'고객접수번호를 입력해주세요.',

		];
		$this->validate($request, [
			's_uid' => 'bail|required|numeric',
			's_ceo_name' => 'required',
			's_addr1' => 'required',
			's_ceo_hp' => 'required',
		],$messages);


		try{
			$staff = AuctionStaff::find($session['idx']);
			//$staff = AuctionStaff::find($request->s_uid);

			// 원하는 값 수정
			$staff->s_career = $request->s_career;
			$staff->s_staff_num = $request->s_staff_num;

			$staff->s_bank_title = $request->s_bank_title;
			$staff->s_bank_ac_name = $request->s_bank_ac_name;
			$staff->s_bank_ac_number = $request->s_bank_ac_number;
			$staff->s_ceo_name = $request->s_ceo_name;
			$staff->s_zip = $request->s_zip;
			$staff->s_addr1 = $request->s_addr1;
			$staff->s_addr2 = $request->s_addr2;
			$staff->s_ceo_hp = $request->s_ceo_hp;
			$staff->s_ceo_hp_plus = $request->s_ceo_hp_plus;
			$staff->s_sadari = $request->s_sadari;
			$staff->s_r_05t = $request->s_r_05t;
			$staff->s_d_05t = $request->s_d_05t;
			$staff->s_1t = $request->s_1t;
			$staff->s_2_5t = $request->s_2_5t;
			$staff->s_5t = $request->s_5t;
			$staff->s_mobile_memo = $request->s_mobile_memo;

			$pay = array();
			if( $request->s_payment ){
				foreach( $request->s_payment as $item){
					$pay[] = $item;
				}
			}
			$staff->s_payment = implode('|', $pay);

			// 삭제된 이미지 찾아서 제거
			// 이미지 순서 앞으로 당기는 작업 필요.
			$ck_num = 1;
			if($request->delfile){
				for( $j = 0 ; $j < 4 ; $j++){
					if(in_array($j,$request->delfile)){
						$file_pos = "s_mobile_img3_".($j + 1);
						$file_info = $staff->$file_pos;
						$file_url = $file_info[0]->path."/".$file_info[0]->file_name_real;

						//dd($file_url);
						$this->delfile( $file_url);
						$staff->$file_pos = null; //해당 필드내용 삭제
						//$file->delete(); // table 삭제가 아니기 때문에 제외
					}
				}
			}

			// 추가된 서브 이미지 확인
			$files1 = $request->file('upload_img1');
			if($request->hasFile('upload_img1'))
			{
				foreach ($files1 as $file1) {
					for( $k = $ck_num ; $k < 5 ; $k++){
						$file_pos = "s_mobile_img3_".$k;
						$file_info = $staff->$file_pos;
						if($file_info == null){
							$staff->$file_pos = $this->uploadImage( $file1 );
							break;
						}
					}
					//dd($this->uploadImage( $file1 ));
				}
			}

			// 메인 이미지 업로드시 변경
			$files0 = $request->file('upload_img0');
			if($request->hasFile('upload_img0'))
			{
					foreach ($files0 as $file0) {
						$staff->s_mobile_img0 = $this->uploadImage( $file0 );
					}
			}




			//dd($file_em2);
			$staff->save();
			return $this->success($staff, '내 정보가 수정 되었습니다.');
		}catch ( \Exception $e){
			return $this->error('내 정보 업데이트에 실패 하였습니다.'.$e, 422);
		}


	}

	private function delfile($path){
		$storage = Storage::disk('public');
		if ( $path !== null ){
			if($storage->exists($path) ){
				$storage->delete($path);
			}
			if($storage->exists('/thumb/'.$path) ){
				$storage->delete('/thumb/'.$path);
			}
		}
	}

	private function uploadImage( UploadedFile $file = null)
	{
		if ($file === null) return null;

		$storage = Storage::disk('public');
		$path = 'staff/'.Carbon::now()->format('ymd').'/';

		$image = Image::make($file);

		$image_name = $this->generateFileName($file);

		if (!$storage->exists($path)) {
		    $storage->makeDirectory($path, 0775, true);
		}


		if (!$storage->exists('thumb/'.$path)) {
		    $storage->makeDirectory($path, 0775, true);
		}
		$storage->put($path . $image_name, $image->stream()->__toString());

		$image->resize('200', null, function ($constraint) {
				$constraint->aspectRatio();
		});
		$storage->put('thumb/'.$path . $image_name, $image->stream()->__toString());


		$size=  $file->getSize();
		$origin =  $file->getClientOriginalName() ;
		$url = '/community/storage/'.$path;
		$thumb = '/community/storage/thumb/'.$path . $image_name;


		//$file_arr = [ "file_name" => $origin, "file_name_real"=>$image_name, "file_size"=> $size, "path"=> $url, "thumb"=> $thumb ];

		// 파일명 디비저장
		$fileSet[0]['file_name'] = $origin;
		$fileSet[0]['file_name_real'] = $image_name;
		$fileSet[0]['file_size'] = $size;
		$fileSet[0]['path']  = $url;
		$fileSet[0]['thumb']  = $thumb;

		/*
		PostFile::create([
			'post_id'=>$post_id,
			'original_name'=> $origin,
			'url'=>$url,
			'attach_type'=> 'image',
			'attach_size'=>$size,
		]);
		*/

		return $fileSet;
	}
	private function generateFileName(UploadedFile $file)
	{
		$ext = $file->getClientOriginalExtension();
		return Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $ext;
	}



}
?>
