<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use App\Models\AuctionBbsPostscript;

class ReviewController extends Controller
{
	use ApiResponser;
  function delReview( Request $request){
    $review = AuctionBbsPostscript::where(['b_uid'=>$request->idx])->first();
    if( !$review) return $this->error('후기를 찾을 수 없습니다.', 422);

    $sql = "insert IGNORE into auction_bbs_postscript_deleted select * from auction_bbs_postscript where b_uid = ".$review->b_uid;
    \DB::statement($sql);

    $review->delete();
    $this->avgStar( $review->b_worker_idx);

    return $this->success();
  }
	function index(Request $request){
		//$this->avgStar();
		$data = AuctionBbsPostscript::with(['files'])
			->select ( "*")
			->join( "auction_staff", "auction_bbs_postscript.b_worker_idx",'=',"auction_staff.s_uid")
			->leftJoin('review_logs', "auction_bbs_postscript.b_uid",'=',"review_logs.review_id")
			->leftJoin("star_points", "auction_bbs_postscript.b_worker_idx",'=',"star_points.auction_staff_uid")
			//->orderBy("auction_bbs_postscript.b_reg_date","DESC")
			->orderBy("auction_bbs_postscript.b_uid","DESC")
			;
		 if( $request->search_val) {
			 $data = $data->where( $request->search_sel,'like','%'.$request->search_val.'%' );
		 };
	 	 if( $request->review_sel ) {
	 		 if( $request->review_sel =='불편') $data->where(['b_atype'=> $request->review_sel ]);
	 		 else $data->where('b_atype','<>' ,'불편');
	 	 }
		 $data = $data->orderBy("auction_bbs_postscript.b_uid","DESC")
		 			->paginate(10);
		foreach ( $data as &$row){
			$row->drawStar = $row->avgstar > $row->forcestar ? $row->avgstar :  $row->forcestar;
			$temp = $this->companyGrade($row->drawStar);
			$row->gradeTitle = $temp['title'];
			$row->gradePic = $temp['pic'];

			$row->avg = sprintf( '%.2f', floor(($row->b_star_expost + $row->b_star_finish + $row->b_star_pave + $row->b_star_price + $row->b_star_pro + $row->b_star_kind)/6*10)/10 );
			if( $row->avg > 5 ) $row->avg = "5.00";
			$row->avgstar = ( floor($row->avg *2 ) / 2 );

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

			$row->avgstararr = $this->explodeStar($row->avgstar);
			//$row->b_note = str_replace("&nbsp;"," ", strip_tags(htmlspecialchars_decode($row->b_note,ENT_QUOTES )) );

			$row->b_note =str_replace("&nbsp;"," ", strip_tags(preg_replace('#<br\s*/?>#i', "\n", htmlspecialchars_decode($row->b_note,ENT_QUOTES ))));

		}
		$pagingres = $data->appends($request->except('page'))->links('vendor.pagination.dots',['pagination_eachside'=>3]);
		$customerNumPlus = 100000;
		return $this->success( compact(["data",'pagingres','customerNumPlus']));
	}
}
