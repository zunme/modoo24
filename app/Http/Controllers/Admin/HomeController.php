<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaravelTraceLog;
//use App\Http\Libraries\MobileDetect;
use Carbon\Carbon;

use App\Models\AuctionStaff;
use App\Models\LaravelErrorLog;
use App\Traits\ApiResponser;

class HomeController extends Controller
{
	use ApiResponser;

	public function index(Request $request){
		//$agent = new MobileDetect();
 		//$mobileResult = $agent->isMobile();
		$sql = "
		SELECT a.isMobile ,referer, a.referer_domain, a.created_at FROM laravel_trace_logs a
		WHERE created_at > '2022-03-17 12:00:00' AND ip <>'221.154.134.3' and created_at >= ?
		AND `page`='nfacepop' AND `step` = 6
		ORDER BY a.id desc
		";
		$nface = \DB::select( $sql, [Carbon::yesterday()]);

		$sql = "
		SELECT a.isMobile ,referer, a.referer_domain, a.created_at FROM laravel_trace_logs a
		WHERE created_at > '2022-03-17 12:00:00' AND ip <>'221.154.134.3' and created_at >= ?
		AND `page`='contact' AND `step` = 6
		ORDER BY a.id desc
		";
		$contact = \DB::select( $sql, [Carbon::yesterday()]);

		\DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
		$sql ="
		SELECT
			COUNT(1) AS cnt , referer, referer_domain
		FROM
		(
		SELECT a.isMobile ,REPLACE(a.referer,' ','') AS referer, a.referer_domain FROM laravel_trace_logs a
		WHERE created_at > '2022-03-17 12:00:00' AND ip <>'221.154.134.3' and created_at >= ?
		AND PAGE='home'
		#AND referer_domain LIKE '%naver%'
		GROUP BY a.uniqueId
		) b
		GROUP BY referer, referer_domain
		ORDER BY 1 desc

		";
		$logs = \DB::select( $sql, [Carbon::yesterday()]);
		return view('admin/home',compact(['nface','logs','contact']));
	}
	public function jisik(Request $request){

		return view('admin/jisik');
	}
	public function logs(Request $request, $id){
		$logs = LaravelErrorLog::where(['parent_id'=>$id, 'type'=>'contact'])->latest()->get();
		$retLogs = [];

		foreach( $logs as $row){
			$companies = array();
			if( isset($row->data->company) && is_array($row->data->company) && count($row->data->company)>0){
				foreach( $row->data->company as $company){
					$companies[] = AuctionStaff::where('s_uid', '=' ,$company)->first();
				}
			}
			$row->companies=$companies;
			$retLogs[] = $row;
		}

		return view('admin/logs',compact(['retLogs']));
	}
	public function logselected(Request $request, $id){
		$logs = LaravelErrorLog::where(['parent_id'=>$id, 'type'=>'contact'])->latest()->get();
		$retLogs = [];

		foreach( $logs as $row){
			$companies = array();
			if( isset($row->data->company) && is_array($row->data->company) && count($row->data->company)>0){
				foreach( $row->data->company as $company){
					$companies[] = AuctionStaff::where('s_uid', '=' ,$company)->first();
				}
			}
			$row->companies=$companies;
			$retLogs[] = $row;
		}
		return $this->success( $retLogs );
	}
}
?>
