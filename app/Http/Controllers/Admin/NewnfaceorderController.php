<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

//use App\Http\Libraries\MobileDetect;
/* TODO */
use App\Models\AuctionOrderNface;

use App\Traits\ApiResponser;
class NewnfaceorderController extends Controller
{
  use ApiResponser;

  public function getInfo($uid){
    /* TODO */
    //$uid =8;
    $data = AuctionOrderNface::where(['uid'=>$uid])->first();

    if( !$data) return $this->error('데이터가 없습니다', 404);
    else return $this->success( $data);
  }
  public function loginfo(Request $requet){
    //$logs = $this->getlog( $requet );
    return view('admin/newpoplog');
  }
  public function getlog(Request $request){

    $exceptIp = ['221.154.134.3'];
    if( $request->exceptip ) $officeIps = "AND ip NOT IN ( '" . implode( "', '" , $exceptIp ) . "' )";
    else $officeIps = '';

    /*이탈률,전환률, 실전환률*/
    $startdate = Carbon::now()->subDays(7)->format('Y-m-d 00:00:00');
    $enddate = Carbon::now()->format('Y-m-d 23:59:00');
    $page = 'nfacepop';
    \DB::statement("SET SQL_MODE=''");
    $sql = "
    SELECT *,
      	(step1 / total * 100) step1_bounce,
      	(step2 / total * 100) step2_bounce,
      	(step3 / total * 100) step3_bounce,
      	(step4 / total * 100) step4_bounce,
      	(step5 / total * 100) step5_bounce,
      	(step6 / total * 100) step6_completed,
      	(step6 / uniquenum * 100) real_colpleted
      FROM (
      	SELECT dd as logdate, total, uniquenum,
      	 ifnull( SUM( case when step = 1 then cnt END ),0) AS step1 ,
      	 ifnull( SUM( case when step = 2 then cnt END ),0) AS step2,
      	 ifnull( SUM( case when step = 3 then cnt END ),0) AS step3,
      	 ifnull( SUM( case when step = 4 then cnt END ),0) AS step4,
      	 ifnull( SUM( case when step = 5 then cnt END ),0) AS step5,
      	 ifnull( SUM( case when step = 6 then cnt END ),0) AS step6
      	FROM(
      		SELECT a.dd, a.total, c.uniquenum,b.step, b.cnt ,tranceval
      		from
      		(SELECT date_format(updated_at ,'%Y-%m-%d') AS dd,COUNT(1) AS total FROM laravel_trace_logs
      		WHERE updated_at BETWEEN :startdate AND :enddate and page = '$page'
          $officeIps
      		GROUP BY date_format(updated_at ,'%Y%m%d') ) a
      		LEFT JOIN (
      		SELECT date_format(updated_at ,'%Y-%m-%d') AS dd,step,  COUNT(1) AS cnt, tranceval FROM laravel_trace_logs
      		WHERE updated_at  BETWEEN :startdate2 AND :enddate2 and page = '$page'
          $officeIps
      		GROUP BY date_format(updated_at ,'%Y%m%d'), step
      		) b ON a.dd = b.dd
      		LEFT JOIN (
      			SELECT date_format(updated_at ,'%Y-%m-%d') dd , COUNT(distinct(uniqueid)) AS uniquenum FROM laravel_trace_logs
      			WHERE updated_at  BETWEEN :startdate3 AND :enddate3 and page = '$page'
            $officeIps
      			GROUP BY date_format(updated_at ,'%Y%m%d')
      		) c ON a.dd = c.dd
      	) dataset
      	GROUP BY dd
      ) totalset
    ";
    $data =  \DB::select( $sql,["startdate" => $startdate, "enddate" => $enddate,"startdate2" => $startdate, "enddate2" => $enddate,"startdate3" => $startdate, "enddate3" => $enddate]) ;
    if($request->ajax()) return $this->success( $data );
    else return $data;
  }
}
?>
