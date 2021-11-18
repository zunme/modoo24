<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\AuctionTempOrder;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;

use App\Traits\ApiResponser;

use App\Models\CalendarLunar;
use App\Models\BulletinSido;
use App\Models\PostComment;

class DefaultlistController extends Controller
{
	use ApiResponser;
	public $company_points_cache;

	public function sonList(Request $request){
		$data = CalendarLunar::
		/*
			select(
		//	\DB::raw('"" as title'),
			\DB::raw("date_format(solar_date, '%Y-%m-%d') as start"),'overlap',
		//	\DB::raw("date_format(solar_date, '%Y-%m-%d') as end")
		//\DB::raw('"false" as overlap'),
		\DB::raw('"background" as display'),
		\DB::raw('"00b9ba" as backgroundColor')
			 )
		->*/where('solar_date','>=', $request->start)
		->where('solar_date','<=', $request->end)
		->where(function($q) {
          $q->where('son', 0)
            ->orWhere('son', 9);
      })
		->get();

		return response()->json( $data);
	}
	public function gugun(Request $request){
		if( $request->si_code == '36110'){
			$data = BulletinSido::
							select('code', 'dong_code as gu_code', \DB::raw("CONCAT(gu, ' ', dong) AS gu"))
							->where(['si_code'=>$request->si_code, 'depth'=>'2'])->get();
		}else {
			$data = BulletinSido::
							select('code', 'gu_code', 'gu')
							->where(['si_code'=>$request->si_code, 'depth'=>'2'])->get();
		}
		return response()->json( $data);
	}
	public function makeinc(){
		$sub_header = view('header-sub')->render();
		$fp = fopen("/home/modoo24/public_html/NEW/include/sub_header.php","wb");
		fwrite($fp,$sub_header);
		fclose($fp);

		$sub_header = view('header')->render();
		$fp = fopen("/home/modoo24/public_html/NEW/include/header.php","wb");
		fwrite($fp,$sub_header);
		fclose($fp);

		$sub_header = view('footer')->render();
		$fp = fopen("/home/modoo24/public_html/NEW/include/footer.php","wb");
		fwrite($fp,$sub_header);
		fclose($fp);
		echo "/home/modoo24/public_html/NEW/include 에 헤더 , 풋터 생성완료";
	}
	public function communityGrade(Request $request){
		session_start();
		$session =  $_SESSION;
		session_write_close();

		if( !isset($session['idx']) || empty($session['idx']) ){
			return $this->error('로그인후 사용해주세요.', 422);
		}

		$statics = $this->communityStatics($session['idx']);
		if( $statics ) $cnt = $statics->cnt;
		else $cnt = 0;

		$ret = ["cnt"=>$cnt, "title"=>$this->communityGradeFullTitle($cnt), "short_title"=>$this->communityGradeTitle($cnt)];
		return $this->success( $ret);
	}
	public function evaluationGrade(Request $request){
		session_start();
		$session =  $_SESSION;
		session_write_close();

		if( !isset($session['idx']) || empty($session['idx']) ){
			return $this->error('로그인후 사용해주세요.', 422);
		}

		$uid = $session['idx'];
		$data = $this->evaluationStatics( $uid );
		$data->stars = $this->explodeStar( $data->total);
		return $this->success( $data );
	}
	public function bestRangeCount(Request $request){
		session_start();
		$session =  $_SESSION;
		session_write_close();

		if( !isset($session['idx']) || empty($session['idx']) ){
			return $this->error('로그인후 사용해주세요.', 422);
		}

		$uid = $session['idx'];
		$range = ( ( $request->range) ?  $request->range : 3 ) -1;

		$dt = Carbon::now();
		$before = $dt->copy()->subMonth($range);
		$yy= $before->format('Y');
		$mm = $before->format('m');
		$res =[];
		for( $yy ; $yy<= $dt->format('Y'); $yy++){
			for( $mm ; $mm<= 12 ; $mm++){
				$res[$yy."-".sprintf('%02d',$mm)]=[
					'yy'=>$yy,
					'mm'=>sprintf('%02d',$mm),
					'count'=>0
					];
				if( $yy == $dt->format('Y') &&  $mm >= $dt->format('m')) break;
			}
			$mm = 1;
		}
		$sql = "
		SELECT ym, COUNT(1) AS cnt
		FROM (

			      SELECT 'best' AS ctype, a.auction_staff_s_uid , DATE_FORMAT( created_at, '%Y-%m') AS ym
			      FROM post_comments a
			      where
			      a.auction_staff_s_uid =? AND a.is_confirmed = 'Y' AND a.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-01 00:00:00')

			      UNION all

			      SELECT 'fav' AS ctype, a.auction_staff_s_uid , DATE_FORMAT( created_at, '%Y-%m') AS ym
			      FROM post_comments a
			      where
			      a.auction_staff_s_uid =? AND a.is_confirmed = 'Y' AND a.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-01 00:00:00')
		) grp
		GROUP BY ym
		";
		$data = \DB::select( $sql,[$uid,$uid]);

		$total = 0;
		foreach( $data as $row ){
			$res[ $row->ym]['count'] = $row->cnt;
			$total +=$row->cnt;
		}
		$cnt = PostComment::where(['auction_staff_s_uid'=>$uid])
			->where( 'created_at','>=', $dt->format('Y-m-01 00:00:00') )->count();
		return $this->success([ "total"=>$total, "data"=>$res,'monthCommentCnt'=>$cnt]);
	}

	public function reviewMain(Request $request){
		$sql = "
		SELECT a.b_uid,b_worker_idx , a.b_mdate,a.b_note,a.b_star_expost,a.b_star_finish,a.b_star_pave,a.b_star_price,a.b_star_pro,b_star_kind , a.b_type,
		b.s_company ,
		s.cnt,
		if( if( s.forcestar > 0 , s.forcestar , s.avgstar ) > 5 , 5 ,if( s.forcestar > 0 , s.forcestar , s.avgstar ) )  AS totalstar,
		a.b_reg_date
		from auction_bbs_postscript a
		join auction_staff b ON a.b_worker_idx = b.s_uid
		JOIN star_points s ON a.b_worker_idx = s.auction_staff_uid

		WHERE a.b_admin_flag ='Y'
			AND b_type IN('이사', '비대면이사')
		";

		if( $request->id ){
				$sql .='AND a.b_uid >= '. (int)$request->id.' limit 1';
		}else {
			$sql .= "
			AND a.b_uid >= 6334
			and a.b_reg_date > DATE_SUB( NOW() , INTERVAL 3 MONTH)
			AND if( s.forcestar > 0 , s.forcestar , s.avgstar ) >= 4.3

			ORDER BY RAND()
					LIMIT 10
			";
		}

		$data = \DB::select($sql);
		foreach ( $data as &$row){
			$row->b_star_expost = $row->b_star_expost == 0 ? 1 : floor($row->b_star_expost);
			$row->b_star_expost_arr = $this->explodeStar($row->b_star_expost);
			$row->b_star_finish = $row->b_star_finish == 0 ? 1 : floor($row->b_star_finish);
			$row->b_star_finish_arr = $this->explodeStar($row->b_star_finish);
			$row->b_star_pave = $row->b_star_pave == 0 ? 1 : floor($row->b_star_pave);
			$row->b_star_pave_arr = $this->explodeStar($row->b_star_pave);
			$row->b_star_price = $row->b_star_price == 0 ? 1 : floor($row->b_star_price);
			$row->b_star_price_arr = $this->explodeStar($row->b_star_price);
			$row->b_star_pro = $row->b_star_pro == 0 ? 1 : floor($row->b_star_pro);
			$row->b_star_pro_arr = $this->explodeStar($row->b_star_pro);
			$row->b_star_kind = $row->b_star_kind == 0 ? 1 : floor($row->b_star_kind);
			$row->b_star_kind_arr = $this->explodeStar($row->b_star_kind);
			/*
			$row->avg = sprintf( '%.1f', floor(($row->b_star_expost + $row->b_star_finish + $row->b_star_pave + $row->b_star_price + $row->b_star_pro + $row->b_star_kind)/6*10)/10 );
			$row->avgstar = ( floor($row->avg *2 ) / 2 );
			*/
			$row->avg =$row->avgstar = $row->totalstar;

			$row->avgstararr = [];
			$row->avgstararr = $this->explodeStar($row->avgstar);

			$row->b_note = htmlspecialchars_decode($row->b_note);
			$tmp =  $this->evaluationStatics( $row->b_worker_idx);
			$row->company_point_title = $tmp->title;
		}
		if ( count( $data) == 1 ) $data = $data[0];

		return $this->success($data);
	}
	/*별점 평균 작업 */
	public function avgStarReq(Request $request){
		$avg = '3.5';
		$sql = "
		INSERT INTO star_points
		SELECT * FROM (

			SELECT auction_staff_uid,total,cnt,@avgval AS avgpoint , star
			 , if(star < @avgval , CAST( ( star + @avgval)/2 AS DECIMAL(10,2) ) , star) AS avgstar
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
						WHERE b_admin_flag ='Y' ". ( ($request->idx )?  'AND a.b_worker_idx='.(int)$request->idx : '' ) ."
					)tmp
					GROUP BY auction_staff_uid
				) grp
			) avgtemp
		)instemp
		ON DUPLICATE KEY UPDATE
			total = instemp.total,
			cnt = instemp.cnt,
			star = instemp.star,
			avgstar = instemp.avgstar
		";
	}

}
