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


class DefaultlistController extends Controller
{
	use ApiResponser;
	public $company_points_cache;


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


	public function reviewMain(Request $request){
		$sql = "
				SELECT a.b_uid,b_worker_idx , a.b_mdate,a.b_note,a.b_star_expost,a.b_star_finish,a.b_star_pave,a.b_star_price,a.b_star_pro,b_star_kind , a.b_type,
				b.s_company from auction_bbs_postscript a
				join auction_staff b ON a.b_worker_idx = b.s_uid
				WHERE a.b_admin_flag ='Y' AND b_type IN('이사', '비대면이사')
		";

		if( $request->id ){
				$sql .='AND a.b_uid >= '. (int)$request->id.' limit 1';
		}else {
			$sql .= "
						AND a.b_uid >= 6334
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

			$row->avg = sprintf( '%.1f', floor(($row->b_star_expost + $row->b_star_finish + $row->b_star_pave + $row->b_star_price + $row->b_star_pro + $row->b_star_kind)/6*10)/10 );
			$row->avgstar = ( floor($row->avg *2 ) / 2 );
			$row->avgstararr = [];
			$row->avgstararr = $this->explodeStar($row->avgstar);

			$row->b_note = htmlspecialchars_decode($row->b_note);
			$row->company_point_title = $this->getCompanyTotal( $row->b_worker_idx);

		}
		if ( count( $data) == 1 ) $data = $data[0];

		return $this->success($data);
	}
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
	private function company_total( $id){
		$sql = "
			SELECT
			round((pro + kind + price + finish + expost + pave)/5/cnt) AS total
			FROM
			(
			SELECT SUM( a.b_star_pro) AS pro, sum(a.b_star_kind) AS kind , SUM( a.b_star_price) AS price, SUM( a.b_star_finish) AS finish
			, SUM( a.b_star_expost) AS expost, SUM(a.b_star_pave) AS pave, count(1) AS cnt
			FROM auction_bbs_postscript a
			WHERE a.b_worker_idx = ".(int)$id."
			) temp
		";
		$data =  \DB::select($sql);
		$data = (!$data[0]->total) ? '1' : $data[0]->total;
		$strArr = [
			"1" => "미흡업체"
			, "2" => "보통업체"
			, "3" => "우수업체"
			, "4" => "최우수업체"
			, "5" => "명예의전당"
		];
		return $strArr[$data];
	}
	private function getCompanyTotal($id){
		if( $this->company_points_cache == null ) {
			$data = \Cache::remember('conpanyStarPoint', 60, function () {
				$sql = "SELECT * ,
					case
						WHEN ( total = 5 ) THEN '명예의전당'
						WHEN ( total > 4 ) then '최우수업체'
						WHEN ( total > 3 ) then '우수업체'
						WHEN ( total > 2 ) then '보통업체'
						ELSE '미흡업체'
					END AS title
					from
					(
					SELECT b_worker_idx, CONCAT('_' , b_worker_idx) AS id,
					 truncate((pro + kind + price + finish + expost )/5/cnt , 1) AS total
					FROM
					(
					SELECT b_worker_idx,
						SUM( if( b_star_pro> 5 , 5 , b_star_pro)) AS pro,
						SUM( if( b_star_price> 5 , 5 , b_star_price)) AS price,
						SUM( if( b_star_finish> 5 , 5 , b_star_finish)) AS finish,
						SUM( if( b_star_expost> 5 , 5 , b_star_expost)) AS expost,
						SUM( if( b_star_kind> 5 , 5 , b_star_kind)) AS kind,
						count(1) AS cnt
					FROM auction_bbs_postscript a
					GROUP BY  a.b_worker_idx
					) temp
					) temp2";
				$data = \DB::select( $sql );
				$res = [];
				foreach ( $data as $row ) $res[ $row->id ] = $row;
				return $res;
			});
			$this->company_points_cache = $data;
		}

		if ( isset( $this->company_points_cache['_'.$id]) ) return $this->company_points_cache['_'.$id]->title;
		else return '';

	}
}
