<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\AuctionOrderNface;
use App\Models\AuctionOrderEstimate;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;

use App\Traits\ApiResponser;
use App\Libraries\Aligo;

class OrderController extends Controller
{
	use ApiResponser;
  // /v1/mypage/mem_apply_ok?cmd=untact_wait&hp=01088066363&uid=191489
  // 비대면 견적 리스트 api
  function nfaceList(Request $request, $uid){
    $info = AuctionOrderNface::where(['uid'=>$uid])->first();
    $list = AuctionOrderEstimate::
      select( 'auction_order_estimate.*','auction_staff.s_company', 'auction_order_contract.o_c_uid as contracted',
        \DB::raw('IFNULL( if( star_points.avgstar  >= ifnull(star_points.forcestar,0) , star_points.avgstar , star_points.forcestar ),1)  AS avgstar'),
        \DB::raw('(round(rand() * 0.19 + 0.01, 1)+4.6) AS avgstar2')
      )
      ->join('auction_staff', "auction_order_estimate.s_uid", "=" ,"auction_staff.s_uid")
      ->leftJoin('star_points', "auction_order_estimate.s_uid", "=" ,"star_points.auction_staff_uid")
      ->leftJoin('auction_order_contract', function($q){
        $q->on('auction_order_estimate.s_uid', '=', 'auction_order_contract.s_uid')
        ->where('auction_order_estimate.uid', '=', 'auction_order_contract.uid');
      })
      ->where(['auction_order_estimate.uid'=>$uid])->get();

      $total = 0;
      $num = $list->count();
      foreach ( $list as $idx =>$row){
        $total += $row->t_pay;
      };
      if( $idx > 0 ) $avg =number_format(round($total / $num ));
      else $avg = 0;
      $now =  Carbon::now();
      $remainingCount = 0;
      $isover = ( $now->diffInHours( $info->reg_date) > 24 ) ? true:false;
      if (!$isover) $remainingCount = 10 - $num;
    return $this->success( compact(['info','list','avg','remainingCount','isover'] ) );
  }
}
