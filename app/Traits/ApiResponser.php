<?php
namespace App\Traits;
use Carbon\Carbon;

trait ApiResponser
{
	protected function success($data=[], $message = null, $code = 200)
	{
		return response()
			//->header('Pragma', 'no-cache')
			//->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
			->json([
			'status' => 'Success',
			'message' => $message,
			'data' => $data
		], $code,['Pragma'=> 'no-cache','Cache-Control'=> 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0']);
	}
	protected function error($message, $code = 422, $data = null)
	{
		return response()->json([
			'status' => 'Error',
			'message' => $message,
			'data' => $data
		], $code,['Pragma'=> 'no-cache','Cache-Control'=> 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0']);
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

	/* 소통점수 */
	private   function communityStatics($id=null) {
		\Cache::forget('companyCommunityGrade');
		$data = \Cache::remember('companyCommunityGrade', 60*10, function () {
			/*
	    $sql = "
	    SELECT auction_staff_s_uid , COUNT(1) AS cnt
	    FROM (
	      SELECT 'best' AS ctype, a.auction_staff_s_uid
	      FROM post_comments a
	      JOIN post_comment_best_logs b ON a.id = b.comment_id
	      where b.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')

	      UNION ALL

	      SELECT 'fav' AS ctype, a.auction_staff_s_uid
	      FROM post_comments a
	      JOIN post_comment_fav_logs b ON a.id = b.comment_id
	      where b.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')
	    ) tmp
	    GROUP BY auction_staff_s_uid
	    ";
			*/
			$sql = "
			SELECT auction_staff_s_uid , COUNT(1) AS cnt
			FROM (
				SELECT 'best' AS ctype, a.auction_staff_s_uid
				FROM post_comments a
				JOIN post_comment_best_logs b ON a.id = b.comment_id
				where b.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')

				UNION ALL

				SELECT 'fav' AS ctype, a.auction_staff_s_uid
				FROM post_comments a
				JOIN post_comment_fav_logs b ON a.id = b.comment_id
				where b.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')
			) tmp
			GROUP BY auction_staff_s_uid
			";
	    $data =  \DB::select( $sql);
	    $res =[];
	    foreach ( $data as $row ) {
	      $res[ '_'. $row->auction_staff_s_uid ] = $row;
	    }
			return $res;
		});
		if( $id ) return isset($data['_'.$id]) ? $data['_'.$id] : null;
	  return $data;
  }
	//6개월 comment 갯수
	private function communityCommentNumStatics($id=null) {
		$data = \Cache::remember('companyCommunityCommentNum', 60*10, function () {
	    $sql = "
			SELECT auction_staff_s_uid , COUNT(1) AS comment_cnt
	    FROM (
	      SELECT 'best' AS ctype, a.auction_staff_s_uid
	      FROM post_comments a
	      where a.is_confirmed = 'Y' AND a.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')

	      UNION ALL

	      SELECT 'fav' AS ctype, a.auction_staff_s_uid
	      FROM post_comments a
	      where a.is_confirmed = 'Y' AND  a.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')
	    ) tmp
	    GROUP BY auction_staff_s_uid
	    ";
	    $data =  \DB::select( $sql);
	    $res =[];
	    foreach ( $data as $row ) {
	      $res[ '_'. $row->auction_staff_s_uid ] = $row;
	    }
			return $res;
		});
		if( $id ) return isset($data['_'.$id]) ? $data['_'.$id] : null;
	  return $data;
  }

	private function communityGradeTitle($total){
		if ( $total >= 7 ) return '명예';
		else if ( $total >= 5 ) return '최우수';
		else if ( $total >= 3 ) return '우수';
		else if ( $total >= 2 ) return '보통';
		else  return '미흡';
	}
	private function communityGradeFullTitle($total){
		if ( $total >= 7 ) return '명예의전당';
		else if ( $total >= 5 ) return '최우수업체';
		else if ( $total >= 3 ) return '우수업체';
		else if ( $total >= 2 ) return '보통업체';
		else  return '미흡업체';
	}

	private function companyGrade($star){
		if( $star >= 4) return ["title"=>"최우수업체", "pic"=>"2"];
		else if( $star >= 3) return ["title"=>"우수업체", "pic"=>"3"];
		else if( $star >= 2) return ["title"=>"일반업체", "pic"=>"4"];
		else return ["title"=>"미흡업체", "pic"=>"5"];
	}

	/* 고객평가점수 */
	private function evaluationStatics($id=null, $all=false){
		$data = \Cache::remember('companyStarPoint', 60*10, function () {
			$sql = "
			SELECT * ,
				case
					WHEN ( total >= 5 ) THEN '명예의전당'
					WHEN ( total > 4 ) then '최우수업체'
					WHEN ( total > 3 ) then '우수업체'
					WHEN ( total > 2 ) then '보통업체'
					ELSE '미흡업체'
				END AS title ,
				case
					WHEN ( total >= 5 ) THEN '명예'
					WHEN ( total > 4 ) then '최우수'
					WHEN ( total > 3 ) then '우수'
					WHEN ( total > 2 ) then '보통'
					ELSE '미흡'
				END AS short_title
			FROM
			(
				select
					b_worker_idx, CAST( ( SUM( total) / COUNT(1)) AS DECIMAL(5,2) ) AS total, COUNT(1) AS cnt
				FROM(
					SELECT a.b_worker_idx,
					CAST(( CAST( IFNULL( if( a.b_star_pro > 5, 5, a.b_star_pro),0) AS DECIMAL(5,2) ) +
					CAST( IFNULL( if( a.b_star_kind > 5, 5, a.b_star_kind),0) AS DECIMAL(5,2) ) +
					CAST( IFNULL( if( a.b_star_price > 5, 5, a.b_star_price),0) AS DECIMAL(5,2) ) +
					CAST( IFNULL( if( a.b_star_finish > 5, 5, a.b_star_finish),0) AS DECIMAL(5,2) ) +
					CAST( IFNULL( if( a.b_star_expost > 5, 5, a.b_star_expost),0) AS DECIMAL(5,2) ) +
					CAST( IFNULL( if( a.b_star_pave > 5, 5, a.b_star_pave),0) AS DECIMAL(5,2) ) ) / 6 AS DECIMAL(10,2) ) AS total
					FROM auction_bbs_postscript a
					WHERE b_worker_idx  > 0
				) grp
				GROUP BY b_worker_idx
			)res
			";
			$data =  \DB::select( $sql);
			$res =[];
			foreach ( $data as $row ) {
				$res[ '_'. $row->b_worker_idx ] = $row;
			}
			return $res;
		});

		if( $id ) {
			if( isset($data['_'.$id]) ) return $data['_'.$id];
			$ret = [
							"b_worker_idx"=>$id, "title"=>"미흡업체", "short_title"=>"미흡",
							"total"=>0, "cnt"=>0,
		 				];
			return $ret;
		}
		else return $data;
	}
	//별점 분리
	private function explodeStar( $data ){
			$ret = [];
			$temp = $data ;
			for( $i = 0 ; $i < 5 ; $i ++ ){
				if( $data >=1 ) $ret[] = '1';
				else if ( $data >= 0.5 ) $ret[] = '0.5';
				else $ret[] = '0';
				$data--;
			}
		return $ret;
	}

	public function avgStar($idx=null){
		$avg = '3.5';

		$sql = "
		INSERT INTO star_points
		SELECT
			auction_staff_uid,total,cnt, avgpoint , star,
			if( avgstar > 5 , 5 , avgstar ) AS avgstar
			,forcestar
		FROM (

			SELECT auction_staff_uid,total,cnt,".$avg." AS avgpoint , star
			 , if(star < ".$avg." , CAST( ( star + ".$avg.")/2 AS DECIMAL(10,2) ) , star) AS avgstar
			 , NULL AS forcestar
			FROM(
				SELECT
				auction_staff_uid,total,cnt ,  CAST( total/cnt/6 AS DECIMAL(10,2) ) AS star
				from
				(
					SELECT auction_staff_uid ,
						SUM( total) AS total, COUNT(1) AS cnt
					from
					(
						SELECT
							a.b_worker_idx AS auction_staff_uid,
							(
							cast(a.b_star_pro AS DECIMAL(5,2) )
							+ cast(a.b_star_kind AS DECIMAL(5,2) )
							+ cast(a.b_star_price AS DECIMAL(5,2) )
							+ cast(a.b_star_finish AS DECIMAL(5,2) )
							+ cast(a.b_star_expost AS DECIMAL(5,2) )
							+ cast(a.b_star_pave AS DECIMAL(5,2) )
							) total
						FROM auction_bbs_postscript a
						". ( ($idx )?  'WHERE a.b_worker_idx='.(int)$idx : '' ) ."
					)tmp
					GROUP BY auction_staff_uid
				) grp
			) avgtemp
		)instemp
		ON DUPLICATE KEY UPDATE
			total = instemp.total,
			cnt = instemp.cnt,
			star = instemp.star,
			avgstar = if(instemp.avgstar > 5 , 5 , instemp.avgstar)
		";
		$res = \DB::statement($sql);
	}
}
