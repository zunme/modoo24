<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use App\Models\AuctionBbsPostscript;

class StaticsController extends Controller
{
	use ApiResponser;

  function cpa(Request $request){
      $yesterday = Carbon::yesterday()->toDateString();
      $start = ($request->start) ? $request->start : $yesterday;
      $end = ($request->end) ? $request->end : $yesterday;

      $sql ="SELECT
           DATE_FORMAT(reg_date,'%Y-%m-%d') m,
           a.cafe_name,
           COUNT(*) AS cnt
        from auction_order a
        WHERE a.reg_date BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:59'
        # AND cafe_name NOT IN ('이사옥션', '모두이사_official_visit' , '모두이사_official_auth', '모두이사_incall')
        GROUP BY a.cafe_name, m
        order by m, a.cafe_name
        ";
      $data = \DB::select( $sql );
      return view( 'admin.statics', compact(['data','start','end']));
  }
}
