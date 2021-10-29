<?php
namespace App\Traits;
use Carbon\Carbon;

trait ApiResponser
{
	protected function success($data=[], $message = null, $code = 200)
	{
		return response()->json([
			'status' => 'Success',
			'message' => $message,
			'data' => $data
		], $code);
	}
	protected function error($message, $code = 422, $data = null)
	{
		return response()->json([
			'status' => 'Error',
			'message' => $message,
			'data' => $data
		], $code);
	}
	protected function sms($number, $title, $message, $image=null)
	{
		/**************** 문자전송하기 예제 ******************/
		# "result_code":결과코드,"message":결과문구,
		# "msg_id":메세지ID,"error_cnt":에러갯수,"success_cnt":성공갯수
		# 동일내용 > 전송용 입니다.
		/******************** 인증정보 ********************/
		$sms_url = "https://apis.aligo.in/send/"; // 전송요청 URL
		$sms['user_id'] = "modoo24"; // SMS 아이디
		$sms['key'] = "jqcikv92tvfqk0obiof3skpuk6w1chp2"; // 인증키
		/******************** 인증정보 ********************/

		$sms['msg'] = stripslashes($message);
		$sms['receiver'] =  $number; // '01111111111,01111111112'; // 수신번호
		//$sms['destination'] = $_POST['destination']; // '01111111111|담당자,01111111112|홍길동'; // 수신인 %고객명% 치환
		$sms['sender'] ="1600-7728"; // 발신번호
		//$sms['rdate'] = date("Ymd"); // 예약일자 - 20161004 : 2016-10-04일기준
		//$sms['rtime'] = date("Hi"); // 예약시간 - 1930 : 오후 7시30분
		//$sms['testmode_yn'] = 'Y'; // Y 인경우 실제문자 전송X , 자동취소(환불) 처리
		if($title) $sms['title'] = $title;

		// 이미지 전송시
		if(!empty($image)){ // '/tmp/pic_57f358af08cf7_sms_.jpg'; // MMS 이미지 파일 위치
			if(file_exists($image)){
				$tmpFile = explode('/', $image);
				$str_filename = $tmpFile[sizeof($tmpFile)-1];
				$tmp_filetype = 'image/jpeg';
				$sms['image'] = '@'.$image.';filename='.$str_filename. ';type='.$tmp_filetype;
			}
		}


		$host_info = explode("/", $sms_url);
		$port = $host_info[0] == 'https:' ? 443 : 80;

		$oCurl = curl_init();
		curl_setopt($oCurl, CURLOPT_PORT, $port);
		curl_setopt($oCurl, CURLOPT_URL, $sms_url);
		curl_setopt($oCurl, CURLOPT_POST, 1);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $sms);
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
		$ret = curl_exec($oCurl);
		curl_close($oCurl);

		//echo $ret;
		$retArr = json_decode($ret, true); // 결과배열
		return $retArr;
	}

	private function getType($type, $data){

		$type_arr = array(
			"1" => "가정이사"
			, "2" => "사무실이사"
			, "3" => "소형이사"
		);

		$t_type_arr = array(
			"1" => "비대면 소형이사"
			, "2" => "비대면 가정이사"
			, "3" => "비대면 사무실이사"
			, "4" => "비대면 차량만"
		);

		$clean_type_arr = array(
			"1" => "입주청소"
			, "2" => "거주청소"
			, "3" => "사무실청소"
		);
		if( $type == 't' ){
			return isset($type_arr[$data]) ? $type_arr[$data] : '';
		}else if( $type == 'clean' ){
			return isset($clean_type_arr[$data]) ? $clean_type_arr[$data] : '';
		}else return isset($type_arr[$data]) ? $type_arr[$data] : '';
	}

}
