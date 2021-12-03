<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\ReviewFile;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;
use App\Models\AuctionBbsPostscript;
use App\Traits\ApiResponser;

class AuctionstaffController extends Controller
{
	use ApiResponser;
  function reviewfiles(Request $request, $s_uid){
    $files = AuctionBbsPostscript::
      select('review_files.*')
      ->where(['b_worker_idx'=>$s_uid])
      ->join('review_files', 'auction_bbs_postscript.b_uid','=','review_files.review_id' )
      ->get();
		$rating = $this->getStaffRating( $request, $s_uid);

		$arr = [];
		foreach ( $rating as $key=>$val){
			if( in_array($key,['star_expost','star_finish','star_kind','star_pave','star_price','star_pro','totalstar']) ) $stararr[$key] = $this->explodeStar($val);
		}
		if( isset($rating->cnt) && $rating->cnt=='0'){
			$companyGrade = ['title'=>'미평가업체', 'pic'=>"2"];
		}
		else $companyGrade = $this->companyGrade( $rating->totalstar);
    return $this->success( compact(['files','rating','companyGrade','stararr']));
  }
	public function getStaffRating( Request $request, $s_uid){
		$sql = "
			SELECT
				tmp.auction_staff_uid,
				if ( star_pro > 5 , 5 ,star_pro) star_pro,
				if ( star_kind > 5 , 5 ,star_kind) star_kind,
				if ( star_price > 5 , 5 ,star_price) star_price,
				if ( star_finish > 5 , 5 ,star_finish) star_finish,
				if ( star_expost > 5 , 5 ,star_expost) star_expost,
				if ( star_pave > 5 , 5, star_pave) star_pave,
				if ( ifnull(avgstar,1) > ifnull(forcestar,0) , ifnull(avgstar,1) , forcestar) totalstar,'1' as cnt
			FROM
			(
				SELECT b_worker_idx as auction_staff_uid,
					CAST(SUM( IFNULL( a.b_star_pro,1) )/COUNT(1) AS DECIMAL(5,2) ) star_pro,
					CAST(SUM( IFNULL( a.b_star_kind,1))/COUNT(1) AS DECIMAL(5,2) ) star_kind,
					CAST(SUM( IFNULL( a.b_star_price,1))/COUNT(1) AS DECIMAL(5,2) ) star_price,
					CAST(SUM( IFNULL( a.b_star_finish,1))/COUNT(1) AS DECIMAL(5,2) ) star_finish,
					CAST(SUM( IFNULL( a.b_star_expost,1))/COUNT(1) AS DECIMAL(5,2) ) star_expost,
					CAST(SUM( IFNULL( a.b_star_pave,1)) / COUNT(1) AS DECIMAL(5,2) ) star_pave
				FROM auction_bbs_postscript
				a WHERE a.b_worker_idx = ?
				group by b_worker_idx
			) tmp
			JOIN star_points ON tmp.auction_staff_uid = star_points.auction_staff_uid
		";
		$rating = \DB::select($sql, [$s_uid]);
		if( count($rating) == 0) {
			$rating =  (object)['auction_staff_uid'=>$s_uid,'star_pro'=>"0",'star_kind'=>"0",'star_price'=>"0"
			,'star_finish'=>"0",'star_expost'=>"0",'star_pave'=>"0",
			'totalstar'=>"4", 'avgpoint'=>'0', 'total'=>'4',
			'avgpoint'=>'0', 'star'=>'1.0','avgstar'=>'0','cnt'=>'0'
			];
			return $rating;
		};
		return $rating[0];
	}
	public function staffReviews(Request $request, $s_uid ){
		$data = AuctionBbsPostscript::with(['files'])
			->select('*',
			\DB::raw( " cast( (b_star_expost+b_star_finish+b_star_kind+b_star_pave+b_star_price+b_star_pro)/6 as decimal(5,2)) as totalrate" )
			)
			->where(['b_worker_idx'=>$s_uid])
			->where(['b_admin_flag'=>'Y'])
			->orderBy('b_reg_date','desc')->paginate( 10 );

		foreach ( $data as &$row){
			if( $row->totalrate > 5 ) $row->totalrate = 5;
			$stararr = [];
			foreach( ['b_star_expost','b_star_finish','b_star_kind','b_star_pave','b_star_price','b_star_pro','totalrate'] as $key){
				$stararr[$key] = $this->explodeStar($row->{$key});
			}
			$row->b_note = str_replace("&nbsp;"," ", strip_tags(htmlspecialchars_decode($row->b_note,ENT_QUOTES )) );
			$row->stararr = $stararr;
		}

		return $this->success( $data );
	}
}
