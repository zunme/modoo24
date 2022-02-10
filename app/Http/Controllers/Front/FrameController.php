<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Traits\ApiResponser;


use App\Models\AuctionBbsPostscript;

use App\Models\BulletinConfig;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentDepth;
use App\Models\PostFile;
use App\Models\AuctionStaff;
use App\Models\PostCommentFavLog;
use App\Models\PostCommentBestLog;
use App\Models\PostCommentLog;
use App\Models\PostFavorite;
use App\Models\BulletinSido;

use Yajra\Datatables\Facades\Datatables;

class FrameController extends Controller
{
  	use ApiResponser;

    function index(Request $request){
      return view('Pages/frameinit');
    }
    function home(Request $request){
      $reviews = $this->reviewMain($request, true);

      $jisik = Post::with(['firstcomment'])->where(['bulletin_id'=>1,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(3)->get();
      $fun = Post::where(['bulletin_id'=>2,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(3)->get();
      $tip = Post::where(['bulletin_id'=>4,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(4)->get();

      $today = Carbon::today()->toDateString();

      return view('Pages/home', compact(['reviews','jisik','fun','tip']));
    }
    function review( Request $request, $id){
      $this->avgStar();

      $row =AuctionBbsPostscript::with(['files'])
  			->select ( "*")
  			->join( "auction_staff", "auction_bbs_postscript.b_worker_idx",'=',"auction_staff.s_uid")
  			->leftJoin("star_points", "auction_bbs_postscript.b_worker_idx",'=',"star_points.auction_staff_uid")
  			->where(["b_uid"=>$id])->first();
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
        $row->b_note = nl2br( str_replace('&nbsp;',' ', strip_tags(str_replace( '</p>', "\n" ,html_entity_decode(str_replace('&nbsp;',' ',$row->b_note) ))) ) );

      return view('Pages/review', compact(['row']) );
    }
    function viewboard(Request $request, $code ,$viewid){
      $user = Auth::user();

      $config = BulletinConfig::active()->where(['code'=>$code])->first();
      if( !$config) return;
      $post = Post::with(['comments','address','files'])->where(['bulletin_id'=> $config->id, 'id'=>$viewid])->first();
      if( $post->is_confirmed =='N' ) return;
  		else if( $post->is_confirmed == 'R' ){
  			if( $user ){
  				if( $user->id != $post->user_id) return;
  			}else return;
  		}
      $post->view_cnt = $post->view_cnt + 1;
  		$post->save();

  		$is_writer = ( Auth::user() && Auth::user()->id == $post->user_id) ? true:false;
  		$post_favorite = false;
  		if ( $user ) {
  			$post_fav = PostFavorite::where(['post_id'=>$post->id , 'user_id'=>$user->id])->count();
  			if( $post_fav > 0 ) $post_favorite = true;
  			else $post_favorite = false;
  		}

      if( $code !='jisik') return view('Front/Bulletin/community/view',compact(['config','post','code','is_writer','post_favorite']));
      else return view('Pages/postsjisik',compact(['config','post','code','is_writer','post_favorite']));
    }
    function postsList(Request $request, $code){
      Carbon::setLocale('ko');
  		$config = BulletinConfig::active()->where(['code'=>$code])->first();
  		if( !$config)	return ;
  		$qry = Post::with(['files'])->where(['bulletin_id'=> $config->id])->where('is_confirmed', '!=','N');
      if( $request->search ){
        if ( $request->search_option == 'cont' )
        {
          $qry =$qry->where(function($query) use ($request) {
            return $query->where('title', 'like', '%'.$request->search.'%')->orWhere('body', 'like', '%'.$request->search.'%');
          });
        }
        else if ( $request->search_option == 'writer' ) $qry =$qry->where('nickname', 'like', '%'.$request->search.'%');
        else $qry = $qry->where('title', 'like', '%'.$request->search.'%');
      }

      return Datatables::of($qry)
      ->addColumn('plainbody', function ($post) {
          if( mb_detect_encoding($post->body) =='ASCII') return strip_tags(mb_convert_encoding($post->body , 'UTF-8', 'HTML-ENTITIES') );
          else return strip_tags($post->body);
      })
      ->addColumn('enctype', function ($post){
        return mb_detect_encoding($post->body);
      })
      ->make(true);
    }

    function reviewMain(Request $request, $retAsObject = false){

      /* Api/DefaultlistController/reviewMain */

      $sql = "
  		SELECT a.b_uid,b_worker_idx , a.b_mdate,a.b_note,a.b_star_expost,a.b_star_finish,a.b_star_pave,a.b_star_price,a.b_star_pro,b_star_kind , a.b_type,
  		b.s_company ,
  		s.cnt,
  		if( if( s.forcestar > 0 , s.forcestar , s.avgstar ) > 5 , 5 ,if( s.forcestar > 0 , s.forcestar , s.avgstar ) )  AS totalstar,
  		a.b_reg_date
  		from auction_bbs_postscript a
  		join auction_staff b ON a.b_worker_idx = b.s_uid
  		JOIN star_points s ON a.b_worker_idx = s.auction_staff_uid

  		WHERE a.b_admin_flag ='Y'
  			AND b_type IN('이사', '비대면이사')
  			AND a.b_atype <> '불편'
  		";

  		if( $request->id ){
  				$sql .='AND a.b_uid >= '. (int)$request->id.' limit 1';
  		}else {
  			$sql .= "
  			AND a.b_uid >= 6334
  			and a.b_reg_date > DATE_SUB( NOW() , INTERVAL 3 MONTH)
  			AND if( s.forcestar > 0 , s.forcestar , s.avgstar ) >= 4.3

  			ORDER BY RAND()
  					LIMIT 10
  			";
  		}

  		$data = \DB::select($sql);
  		foreach ( $data as &$row){

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
  			/*
  			$row->avg = sprintf( '%.1f', floor(($row->b_star_expost + $row->b_star_finish + $row->b_star_pave + $row->b_star_price + $row->b_star_pro + $row->b_star_kind)/6*10)/10 );
  			$row->avgstar = ( floor($row->avg *2 ) / 2 );
  			*/
  			// total => 단건으로 바꿈
  			//$row->avg =$row->avgstar = $row->totalstar;

  			$row->avgstararr = [];
  			$row->avgstararr = $this->explodeStar($row->avgstar);

  			$row->b_note = htmlspecialchars_decode($row->b_note);
  			$tmp =  $this->evaluationStatics( $row->b_worker_idx);
  			$row->company_point_title = $tmp->title;
  		}
  		if ( count( $data) == 1 ) $data = $data[0];

      if($retAsObject) return $data;
  		else  return $this->success($data);
    }
    
}
