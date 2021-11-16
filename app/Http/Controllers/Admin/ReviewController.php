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
}
