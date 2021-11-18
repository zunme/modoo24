<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;

use Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Traits\ApiResponser;

use App\Models\AuctionOrder;
use App\Models\AuctionStaff;
use App\Models\AuctionOrderContract;
use App\Models\AuctionOrderEstimate;


class ReviewController extends Controller
{
	use ApiResponser;
	function __construct(){
		$this->exclsComp = ['736','80'];
	}
  public function myReview(Request $request){
			$data = $this->getUserdata( $request);
			if( $data === false ) return view("Front.Review.auth");
			else return $this->myApplyList($request, $data);
  }
	public function companylist( Request $request){
		$userdata = $this->getUserdata($request);
		if( $userdata === false ) return $this->error("전화번호 인증 후 사용해주세요", 422);
		else if( $request->uid < 1 ) return $this->error("잘못된 요청입니다.", 422);

		$row = AuctionOrder::where(['uid'=>$request->uid])->first();
		$company = [];
		if( $row->s_uid1 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $company[] = $row->s_uid1;
		if( $row->s_uid2 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $company[] = $row->s_uid2;
		if( $row->s_uid3 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $company[] = $row->s_uid3;

		$companyData = AuctionStaff::select('s_company','s_nickname','s_license1','s_addr1')->whereIn( 's_uid', $company)->get();
		$row->companyData = $companyData;
		return $this->success($row);
	}

	private function  getUserdata(Request $request){
		$user = Auth::user();

		if( $user && $user->phone && $user->name){
				return ['name'=>$user->name, "phone"=>$user->phone];
		}else if( $request->session()->has('userAuth') ){
			$authArr =  $request->session()->get('userAuth');
			if( isset($authArr['tel']) && isset($authArr['name']) ){
				return ['name'=>$authArr['name'], "phone"=>$authArr['tel'] ];
			}
		}
		return false;
	}

	private function myApplyList($request, $userdata){
		//제외될 업체 : 히 이중오더 736, 히 모두이사 80
		$limitdate = $newDateTime = Carbon::now()->subMonths(6)->format('Y-m-d');

		$sql = "
		select * from (
			SELECT
			 '방문' as kind,'auction_order' as kindtype, uid, s_uid1,s_uid2,s_uid3, s_uid1_memo,s_uid2_memo,s_uid3_memo, ton, reg_date, classify, mdate, s_addr1 AS startaddr, e_addr1 AS endaddr, `name` AS username
			 FROM auction_order
			 WHERE
				 mdate >= ?
				 and REPLACE(hp, '-', '') = ?
			UNION ALL
			 SELECT '비대면' as kind,'auction_order_nface' as kindtype, uid, s_uid1,s_uid2,s_uid3, s_uid1_memo,s_uid2_memo,s_uid3_memo, ton, reg_date, classify, mdate , s_addr1 AS startaddr, e_addr1 AS endaddr, `name` AS username
			 FROM auction_order_nface
			 WHERE
				 mdate >= ?
				 and REPLACE(hp, '-', '') = ?
			) tmp order by mdate desc
		";
		$data = \DB::select($sql,[ $limitdate,$userdata['phone'], $limitdate,$userdata['phone'] ]);
		foreach ( $data as &$row){
			if ( $row->kind =="방문") {
				$staff_cnt = 0;
				if( $row->s_uid1 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $staff_cnt++;
				if( $row->s_uid2 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $staff_cnt++;
				if( $row->s_uid3 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $staff_cnt++;
				$row->staff_cnt = $staff_cnt;
				$row->kind_title = "방문 " . $this->getType('type',$row->classify);
			} else if($row->kind == "비대면") {

					$row->d_cnt = AuctionOrderContract::where(['uid'=>$row->uid])->whereNotIn('s_uid',$this->exclsComp)->count();
					if( $row->d_cnt < 1) $row->c_cnt = AuctionOrderEstimate::where(['uid'=>$row->uid])->whereNotIn('s_uid',$this->exclsComp)->count();
					$row->kind_title = "비대면";
			}
		}

		return view("Front.Review.availlist", compact("data"));
	}

}
