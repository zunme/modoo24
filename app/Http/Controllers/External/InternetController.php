<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Carbon\Carbon;
use App\Traits\ApiResponser;

/* TODO */
use App\Models\AuctionOrderNface;
use App\Models\AuctionOrder;

class InternetController extends Controller
{
	  use ApiResponser;
    public function __construct(){
      $this->users = [
        'externalId1'=>'llsdo0304'
      ];
      $this->nameview = false;
    }
		function check(Request $request){
			$data = $request->all();
			$order = $norder=[];
			if( $data['방문'] ){
				$order = AuctionOrder::select('uid')->whereIn('uid', $data['방문'])->where('name','=','고객정보삭제')->get();
			}
			if( isset($data['비대면']) ){
				$norder = AuctionOrderNface::select('uid')->whereIn('uid', $data['비대면'])->where(['name'=>'고객정보삭제'])->get();
			}
			$data = ['o'=>$order, 'n'=>$norder];
			return $this->success($data);
		}
	  function index(Request $request){
      if( !$request->session()->has('ExternalAuth') ){
        if( $request->userid && $request->password){
            if( isset($this->users[ $request->userid ] ) && $this->users[ $request->userid ] == $request->password ){
              $request->session()->put('ExternalAuth', [ 'eAuthId'=> $request->userid ]);
            }else return \Redirect::back()->withErrors(['msg' => '아이디와 패스워드를 확인해주세요'])->withInput($request->except("password"));
        }
        else return view('External.login');
      }
      return $this->internetlist($request);
    }
    function internetlist(Request $request){
			$hp = $request->hp;
      $nameview = $this->nameview;
			$paginate = 10;
			/*
      $data = AuctionOrderNface::where(['s_uid'=>'0'])
      ->where('name', 'not like', "%테스트%")
      ->where('name', 'not like', "%삭제%")
      ->whereDate('mdate', '>=', Carbon::today()->toDateString())
      ->orderBy('reg_date','desc')->paginate(20);
      foreach( $data as &$row){
        $row->hp = $this->format_tel($row->hp);
      }
      return view('External.internetlist', compact(['data','nameview']));
			*/
			$enddate = $startdate = $enddate_format = $startdate_format= null;
			if( $request->startdate ){
				try{
					$startdate = Carbon::parse($request->startdate)->format('Y-m-d 00:00:00');
					$startdate_format = Carbon::parse($request->startdate)->format('Y-m-d');
				}catch(\Exception $e){

				}
			}else {
				$startdate =Carbon::now()->subdays(7)->format('Y-m-d 00:00:00');
				$startdate_format =Carbon::now()->subdays(7)->format('Y-m-d');
			}
			//이사일이 60일내외이므로 61일전부터만 보게
			$beforemonth = Carbon::now()->subdays(61)->format('Y-m-d 00:00:00');

			if( $startdate < $beforemonth){
				$startdat = $beforemonth;
				$startdate_format = Carbon::now()->subdays(61)->format('Y-m-d');
			}
			if( $request->enddate ){
				try{
					$enddate = Carbon::parse($request->enddate)->format('Y-m-d 23:59:59');
					$enddate_format = Carbon::parse($request->enddate)->format('Y-m-d');
				}catch(\Exception $e){

				}
			}
			$a = DB::table("auction_order")->select('uid','mdate','hp','reg_date',\DB::raw("'방문' as type"),\DB::raw('if( mdate >= "'.Carbon::today()->toDateString().'" , "Y","N" ) isView'))->where(['s_uid'=>'1'])
	      ->where('name', 'not like', "%테스트%")
	      ->where('name', 'not like', "%삭제%")
	      //->whereDate('mdate', '>=', Carbon::today()->toDateString())
				->where('reg_date','>=','2022-04-01 00:00:00')
				->where('share_status','=','DONE')
				;
				if( $request->hp )$a = $a->where('hp','like','%'.preg_replace('/[^0-9]/', '', $request->hp).'%');
				if( $startdate )$a = $a->where('reg_date','>=', $startdate);
				if( $enddate )$a = $a->where('reg_date','<=', $enddate);
	      $a = $a->orderBy('reg_date','desc');
				$cnt1 = $a->count();
			$data = DB::table("auction_order_nface")->select('uid','mdate','hp','reg_date',\DB::raw("'비대면' as type"),\DB::raw('if( mdate >= "'.Carbon::today()->toDateString().'" , "Y","N" ) isView'))->where(['s_uid'=>'1'])
	      ->where('name', 'not like', "%테스트%")
	      ->where('name', 'not like', "%삭제%")
	      //->whereDate('mdate', '>=', Carbon::today()->toDateString())
				->where('reg_date','>=','2022-04-01 00:00:00');
				if( $startdate )$data = $data->where('reg_date','>=', $startdate);
				if( $enddate )$data = $data->where('reg_date','<=', $enddate);

			if( $request->hp ) $data = $data->where('hp','like','%'.preg_replace('/[^0-9]/', '', $request->hp).'%');

			$data = $data->union($a)
	      ->orderBy('reg_date','desc')
				->get();
			$page = $request->page;
			$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
			$total = $data->count();
			$cnt = ['방문'=>$cnt1, '비대면'=>($total - $cnt1)];
			$data = $this->paginate($data,$paginate,$page,['path'  => $request->url(),'query' => $request->query()] );
			$js=[];
			foreach ( $data as $row){
				$js[$row->type][] = $row->uid;
			}
			return view('External.internetlist',compact('data','nameview','page','paginate','hp','enddate','startdate','startdate_format','enddate_format','total','cnt','js'));
    }
		public function paginate($items, $perPage = 5, $page = null, $options = [])
		{
				$page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
				$items = $items instanceof Collection ? $items : Collection::make($items);
				$paginator =  new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
     		return $paginator;
		}
		private function format_tel($tel) {
    $tel = preg_replace('/[^0-9]/', '', $tel);
	    return preg_replace('/(^02.{0}|^01.{1}|^15.{2}|^16.{2}|^18.{2}|[0-9]{3})([0-9]+)([0-9]{4})/', '$1-$2-$3', $tel);
		}
}
