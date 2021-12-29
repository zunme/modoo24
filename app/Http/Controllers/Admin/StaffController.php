<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\AuctionStaff;

use App\Models\PostComment;
use App\Models\PostCommentBestLog;
use App\Models\PostCommentFavLog;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

class StaffController extends Controller
{
	use ApiResponser;
	function staffInfo( Request $request){
		$messages = [
        'id.*' => '유저 아이디가 필요합니다.',
    ];
    $this->validate($request, [
      'id' => 'bail|required|numeric',
     ],$messages);
		$user = AuctionStaff::with(['commentlogs'])->find( $request->id);
		if( !$user ) return $this->error('유저를 찾을 수 없습니다.', 422);
		return $this->success( $user );
	}

	function staticsv2 ( Request $request ){
		$range = ( $request->range && $request->range > 0 )? $request->range : '6';
		$statics = $this->communityStaticsv2();
		$staffpoint = $this->getSiteConfig('staffpoint');

		$postcnt = "
			select
				auction_staff_s_uid, COUNT(1) AS comment_cnt
			FROM post_comments
			WHERE post_comments.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL ".$range." MONTH), '%Y-%m-%d 00:00:00')
			and post_comments.is_confirmed ='Y'
			GROUP BY auction_staff_s_uid
		";
		$bestcnt = "
			SELECT a.auction_staff_s_uid, COUNT(1) AS cnt,
				SUM( if( ctype ='best' , 1 , 0 ) ) AS best_cnt,
				SUM( if( ctype ='fav' , 1 , 0 ) ) AS fav_cnt
			FROM post_comments a
			JOIN
				(
					SELECT 'best' AS ctype, comment_id
					FROM post_comments a1
					join post_comment_best_logs ON a1.id = post_comment_best_logs.comment_id
					where post_comment_best_logs.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL ".$range." MONTH), '%Y-%m-%d 00:00:00')
						AND a1.is_confirmed ='Y'
					UNION ALL
					SELECT 'fav' AS ctype, comment_id
					FROM post_comments a2
					join post_comment_fav_logs ON a2.id = post_comment_fav_logs.comment_id
					where post_comment_fav_logs.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL ".$range." MONTH), '%Y-%m-%d 00:00:00')
						AND a2.is_confirmed ='Y'
				)grp1 ON a.id = grp1.comment_id
			GROUP BY a.auction_staff_s_uid
		";
		$click="
			select
				auction_staff_s_uid, COUNT(1) AS click_cnt
			FROM post_comment_fav_logs
			where post_comment_fav_logs.created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')
			GROUP BY auction_staff_s_uid
		";
	 $user = AuctionStaff::
	 	select( 'auction_staff.*'
	 		, \DB::raw('IFNULL( bestcnt.cnt , 0 ) AS totalcnt')
			, \DB::raw('IFNULL( bestcnt.best_cnt , 0 ) AS user_cnt')
			, \DB::raw('IFNULL( bestcnt.fav_cnt , 0 ) AS staff_cnt')
			, \DB::raw('IFNULL( click.click_cnt , 0 ) AS click_cnt')
			, \DB::raw('IFNULL( postcnt.comment_cnt , 0 ) comment_cnt')
			, \DB::raw("IFNULL( bestcnt.cnt , 0 )* ".$staffpoint['best']." +  IFNULL( click.click_cnt , 0 )*".$staffpoint['click']." +  IFNULL( postcnt.comment_cnt , 0 )*".$staffpoint['comment']." AS   total_point")
	   )
		 ->leftJoin(
			 \DB::raw('(' . $postcnt. ') AS postcnt' ),
			 function( $join) {
				 $join->on( 'auction_staff.s_uid','=', 'postcnt.auction_staff_s_uid');
			 }
		 )
		 ->leftJoin(
			 \DB::raw('(' . $bestcnt. ') AS bestcnt' ),
			 function( $join) {
				 $join->on( 'auction_staff.s_uid','=', 'bestcnt.auction_staff_s_uid');
			 }
		 )
		 ->leftJoin(
			 \DB::raw('(' . $click. ') AS click' ),
			 function( $join) {
				 $join->on( 'auction_staff.s_uid','=', 'click.auction_staff_s_uid');
			 }
		 )
		 ->where('s_level','>',0)
		 ;
		 return Datatables::of($user)
		 ->addColumn( 'grade', function ($user) use($statics) {
			 if( isset($statics["_".$user->s_uid]) ) $total = $statics[ "_".$user->s_uid ]->cnt;
			 else $total = 0;
			 //return $this->communityGradeTitle($total);
			 return $this->communityGradeV2($total);
		 })
		 ->make(true);
	}

}
