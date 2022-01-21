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
use App\Models\AuctionOrderNface;
use App\Models\AuctionStaff;
use App\Models\AuctionOrderContract;
use App\Models\AuctionOrderEstimate;

use App\Models\AuctionBbsPostscript;
use App\Models\ReviewFile;
use App\Models\ReviewLog;

use App\Events\ReviewEvent;
use App\Libraries\Aligo;

class ReviewController extends Controller
{
	use ApiResponser;
	function __construct(){
		/*todo*/
		$this->exclsComp = ['736','80'];
		//$this->exclsComp =[];
		$this->rangeMonth = 6;					// 6개월
		$this->alimhp = ''; // 알림 전화번호 바꿔치기.. '' 로 바꿀것
		$this->customerNumPlus = 100000; // b_uid+
	}
	public function index(Request $request){
		$this->avgStar();
		$data = AuctionBbsPostscript::with(['files'])
			->select ( "*")
			->join( "auction_staff", "auction_bbs_postscript.b_worker_idx",'=',"auction_staff.s_uid")
			->leftJoin("star_points", "auction_bbs_postscript.b_worker_idx",'=',"star_points.auction_staff_uid")
			->where(["b_admin_flag"=>"Y"])
			->orderBy("auction_bbs_postscript.b_reg_date","DESC")
			->orderBy("auction_bbs_postscript.b_uid","DESC")
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
			$row->b_note =str_replace("&nbsp;"," ", strip_tags(preg_replace('#<br\s*/?>#i', "\n", htmlspecialchars_decode($row->b_note,ENT_QUOTES ))));
		}
		$pagingres = $data->appends($request->except('page'))->links('vendor.pagination.dots',['pagination_eachside'=>3]);
		$customerNumPlus = $this->customerNumPlus;
		return view('Front.Review.index', compact(["data",'pagingres','customerNumPlus']));
	}
	public function myReviewList(Request $request){
		$userdata = $this->getUserdata($request);
		if( $userdata === false ) return \Redirect::to('/review/my')->with('warning', '전화번호 인증 후 사용해주세요');
		$data = AuctionBbsPostscript::with(['files','repl'])
			->select('auction_bbs_postscript.*','review_logs.*','auction_staff.s_company','star_points.*')
			->join('review_logs','auction_bbs_postscript.b_uid','=','review_logs.review_id')
			->join('auction_staff','auction_bbs_postscript.b_worker_idx', '=','auction_staff.s_uid' )
			->leftJoin('star_points','auction_bbs_postscript.b_worker_idx', '=','star_points.auction_staff_uid')
			->where(['b_hp'=>$userdata['phone']])
			->orderBy('b_uid','desc')->paginate(10);
			foreach( $data as &$row){
				if( $row->order_type =='order'){
					$row->order = AuctionOrder::select('s_addr1','e_addr1')->where(['uid'=>$row->order_id])->first();
				}else{
					$row->order = AuctionOrderNface::select('s_addr1','e_addr1')->where(['uid'=>$row->order_id])->first();
				}
				$row->companyGrade = $this->companyGrade( $row->avgstar > $row->forcestar ? $row->avgstar : $row->forcestar );
			}
			//dd($data);
		return view("Front/Review/mylist", compact(['data']));
	}
	public function myReviewListApi(Request $request){
		$userdata = $this->getUserdata($request);
		if( $userdata === false ) return $this->error("전화번호 인증 후 사용해주세요", 422);
		$data = AuctionBbsPostscript::where(['b_hp'=>$userdata['phone']])
						->orderBy('b_uid','desc')->paginate(10);

		return $this->success($data);
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

		$companyData = AuctionStaff::select('s_uid','s_company','s_nickname','s_license1','s_addr1')->whereIn( 's_uid', $company)->get();
		$row->companyData = $companyData;
		return $this->success($row);
	}

	public function myReviewWrite(Request $request, $type, $uid, $s_uid){
		$userdata = $this->getUserdata($request);
		if( $userdata === false ) return \Redirect::to('/review/my')->with('warning', '전화번호 인증 후 사용해주세요');
		$b_type = '이사';

		if( $type=="order_nface"){
			$row = AuctionOrderNface::where(['uid'=>$uid])->first();
			if( trim(str_replace('-','',$row->hp)) != $userdata['phone'] ) return $this->error("전화번호가 틀립니다.", 422);
			$comp = AuctionOrderContract::where(['uid'=>$row->uid])->whereNotIn('s_uid',$this->exclsComp)->first();
			$s_uid = $comp->s_uid;
			$b_type = '비대면이사';
		}elseif($type=="order") {
			$row = AuctionOrder::where(['uid'=>$uid])->first();
			if( trim(str_replace('-','',$row->hp)) != $userdata['phone'] ) return $this->error("전화번호가 틀립니다.", 422);
			if( $row->s_uid1 != $s_uid && $row->s_uid2 != $s_uid && $row->s_uid3 != $s_uid ) return $this->error("매칭된 내용이 아닙니다.", 422);

		}else return $this->error("정보를 찾을 수 없습니다.", 422);

		$staff = AuctionStaff::select('s_uid','s_company','s_nickname','s_license1','s_addr1')->where( ['s_uid'=>$s_uid])->first();
		//dd( $row);
		return view('Front.Review.write', compact('row','staff','userdata','type','b_type','uid','s_uid'));
	}

	public function reviewWritePrc(Request $request, $review_type){
		$userdata = $this->getUserdata($request);
		$uid = $request->uid;
		$type = $request->type;
		$s_uid = $request->b_worker_idx;
		/* todo  체크박스 2개 해야함 */
		if( $userdata === false ) return $this->error("전화번호 인증 후 사용해주세요", 422);
		$messages = [
        'b_star_pro.*' => '전문성을 평가해주세요',
				'b_star_kind.*' => '친절성을 평가해주세요',
				'b_star_price.*' => '가격도를 평가해주세요',
				'b_star_finish.*' => '마무리를 평가해주세요',
				'b_star_expost.*' => '사후관리 평가해주세요',
				'b_star_pave.*' => '포장도를 평가해주세요',
				'b_note.*' => '내용을 입력해주세요',
				'agree3.*' => '이용약관 동의가 필요합니다.',
				'agree1.*' => '개인정보 수집 및 이용동의가 필요합니다.',
				'agree2.*' => '제3자 제공동의가 필요합니다.',
    ];
    $this->validate($request, [
      'b_star_pro' => 'bail|required|numeric|min:0.5|max:5',
			'b_star_price' => 'bail|required|numeric|min:0.5|max:5',
			'b_star_expost' => 'bail|required|numeric|min:0.5|max:5',
			'b_star_kind' => 'bail|required|numeric|min:0.5|max:5',
			'b_star_finish' => 'bail|required|numeric|min:0.5|max:5',
			'b_star_pave' => 'bail|required|numeric|min:0.5|max:5',
			'b_note' => 'bail|required|string|min:1',
			'agree3' => 'bail|required|in:Y',
			'agree1' => 'bail|required|in:Y',
			'agree2' => 'bail|required|in:Y',
     ],$messages);

		if( $type=="order_nface"){
			$row = AuctionOrderNface::where(['uid'=>$uid])->first();
			if( trim(str_replace('-','',$row->hp)) != $userdata['phone'] ) return $this->error("전화번호가 틀립니다.", 422);
			$comp = AuctionOrderContract::where(['uid'=>$row->uid, 's_uid'=> $s_uid])->whereNotIn('s_uid',$this->exclsComp)->first();

			if (!$comp || $s_uid != $comp->s_uid)  return $this->error("업체정보가 틀립니다.", 422);
			$b_type = '비대면이사';
		}elseif($type=="order") {
			$row = AuctionOrder::where(['uid'=>$uid])->first();
			if( trim(str_replace('-','',$row->hp)) != $userdata['phone'] ) return $this->error("전화번호가 틀립니다.", 422);
			if( $row->s_uid1 != $s_uid && $row->s_uid2 != $s_uid && $row->s_uid3 != $s_uid ) return $this->error("매칭된 내용이 아닙니다.", 422);
		}else return $this->error("정보를 찾을 수 없습니다.", 422);
		$limitdate = $newDateTime = Carbon::now()->subMonths($this->rangeMonth)->format('Y-m-d');
		if( $row->mdate < $limitdate) return $this->error("후기 등록기간이 지났습니다.", 422);

		$staff = AuctionStaff::where( ['s_uid'=>$s_uid])->first();

		$data = [
			"b_name"=>$userdata['name'],
			"b_ip=>"=>$request->ip(),
			"b_type"=>( $request->type == "order" ) ? "이사" : "비대면이사",
			"b_mdate"=>$row->mdate,
			"b_atype"=> ($review_type =='compliment') ? "후기":'불편'
		];
		\DB::beginTransaction();
		try{
			$review = AuctionBbsPostscript::create(array_merge($request->except(['upload']), $data));
			ReviewLog::create([
				'order_type'=>$type,
				'order_id'=>$uid,
				'review_type'=>($review_type =='compliment') ? "칭찬":'불편',
				'staff_id'=>$s_uid,
				'review_id'=>$review->b_uid,
			]);
			\DB::commit();
		} catch(\Exception $e){
			\DB::rollback();
			if($e->errorInfo[1] == 1062){
	        return $this->error("이미 후기를 등록하셨습니다.");
	    }
			else return $this->error("잠시후에 다시 시도해주세요.");
		}
		$files = $request->file('upload');

		if($request->hasFile('upload'))
		{
				foreach ($files as $file) {
					$this->uploadImage( $file ,$review->b_uid );
				}
		}
		$this->avgStar($s_uid);

		//불편사항 알림
		if($review_type =='inconvenience'){
			$aligo = new Aligo;
			$staff_hp = $this->alimhp !='' ? $this->alimhp : str_replace('-','',$staff->s_ceo_hp);

			$req["#{업체명}"] = $staff->s_company;
			$data = [
				'tpl_code'=>'TG_5327',
				'receiver_1'=>$staff_hp,
				'subject_1'=>'모두이사'
			];
			$aligo->sendKakaoParser($data, $req);
		}
		event(new ReviewEvent( $review));
		return $this->success();
	}
	//이미지 업로드
	private function uploadImage( UploadedFile $file = null, $id)
		{
				if ($file === null) return null;


				$storage = Storage::disk('public');
				$path = 'review/'.Carbon::now()->format('ymd').'/';

				$image = Image::make($file);

				$image_name = $id."_".Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $file->getClientOriginalExtension();

				if (!$storage->exists($path)) {
						$storage->makeDirectory($path, 0775, true);
				}
				$storage->put($path . $image_name, $image->stream()->__toString());

				$size=  $file->getSize();
				$origin =  $file->getClientOriginalName() ;
				$url = '/'.$path . $image_name;
				ReviewFile::create([
					'review_id'=>$id,
					'url'=>$url,
				]);
				return true;
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
		$limitdate = $newDateTime = Carbon::now()->subMonths($this->rangeMonth)->format('Y-m-d');
		$nowdate = Carbon::now()->format('Y-m-d');

		$sql = "
		select * from (
			SELECT
			 '방문' as kind,'auction_order' as kindtype, uid, s_uid1,s_uid2,s_uid3, s_uid1_memo,s_uid2_memo,s_uid3_memo, ton
			 , reg_date, classify, mdate, s_addr1 AS startaddr, e_addr1 AS endaddr, `name` AS username, review_id
			 FROM auction_order
			 left join review_logs on auction_order.uid = review_logs.order_id  and order_type='order'
			 WHERE
				 mdate >= ? and mdate < ?
				 and REPLACE(hp, '-', '') = ?
			UNION ALL
			 SELECT '비대면' as kind,'auction_order_nface' as kindtype, uid, s_uid1,s_uid2,s_uid3, s_uid1_memo,s_uid2_memo,s_uid3_memo, ton
			 , reg_date, classify, mdate , s_addr1 AS startaddr, e_addr1 AS endaddr, `name` AS username, review_id
			 FROM auction_order_nface
			 left join review_logs on auction_order_nface.uid = review_logs.order_id and order_type='order_nface'
			 WHERE
				 mdate >= ? and mdate < ?
				 and REPLACE(hp, '-', '') = ?
			) tmp order by mdate desc
		";
		$data = \DB::select($sql,[ $limitdate,$nowdate,$userdata['phone'], $limitdate,$nowdate,$userdata['phone'] ]);
		foreach ( $data as &$row){
			if ( $row->kind =="방문") {
				$staff_cnt = 0;
				if( $row->s_uid1 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $staff_cnt++;
				if( $row->s_uid2 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $staff_cnt++;
				if( $row->s_uid3 > 0 && !in_array($row->s_uid1, $this->exclsComp ) ) $staff_cnt++;
				$row->staff_cnt = $staff_cnt;
				$row->kind_title = "방문 " . $this->getType('type',$row->classify);
			} else if($row->kind == "비대면") {

					$row->staff_cnt = AuctionOrderContract::where(['uid'=>$row->uid])->whereNotIn('s_uid',$this->exclsComp)->count();
					//견적제안은 가져올필요가 없다
					//if( $row->staff_cnt < 1) $row->staff_cnt2 = AuctionOrderEstimate::where(['uid'=>$row->uid])->whereNotIn('s_uid',$this->exclsComp)->count();

					$row->kind_title = "비대면";
			}
		}
		return view("Front.Review.availlist", compact("data"));
	}

}
