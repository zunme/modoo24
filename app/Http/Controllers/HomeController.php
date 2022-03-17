<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Events\Registered;
use App\Events\Event;
use App\Events\PostEvent;
use App\Events\ReviewEvent;
use App\Events\CommentEvent;

use Validator;
use App\User;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostComment;
use App\Models\PostCommentDepth;
use App\Models\AuctionPopup;

use App\Models\MoveGoodsType;
use App\Models\MoveGoods;

use App\Models\AuctionBbsPostscript;

use App\Models\EventList;

use App\Libraries\Aligo;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use App\Traits\ApiResponser;
use App\Models\LaravelTraceLog;
use App\Http\Libraries\MobileDetect;

class HomeController extends Controller
{
  use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     public function csstest(Request $request){
       $jisik = Post::with(['firstcomment'])->where(['bulletin_id'=>1,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(4)->get();
       $fun = Post::where(['bulletin_id'=>2,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(3)->get();
       $tip = Post::where(['bulletin_id'=>4,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(4)->get();

       $today = Carbon::today()->toDateString();
       $chkMobile = false;

       $notin = [];
       foreach( $_COOKIE as $key =>$val){
         if( $val=='popupviewdone'){
           $tmp = explode( '_', $key);
           if( isset($tmp[2]) ) $notin[] = $tmp[2];
         }
       }
       $startday = Carbon::now()->format('Y-m-d 00:00:00');
       $pops = AuctionPopup::
           where(['bp_use_flag'=>'Y'])
           ->whereNotIn('bp_idx', $notin )
           ->where('bp_start_date','<=',$today )
           ->where('bp_end_date','>=',$today )
           ->get();
       foreach( $pops as &$row){
         $row->pop_w = ($chkMobile) ? ($row->bp_width - 300 ) :($row->bp_width);
         $row->pop_h = ($chkMobile) ? ($row->bp_height - 300 + 76 ) :($row->bp_height+76);
       }

       $ordergoods = MoveGoodsType::with(['items'])->where(['type_use'=>'Y'])->orderBy('type_order_no','asc')->orderBy('id','asc')->get();
       $startday = Carbon::now()->format('Y-m-d 00:00:00');

       if ( $request->testview ) $eventlist = EventList::where([ 'use_main'=>'Y'])->orderby('id', 'desc')->get();
       else $eventlist = EventList::where(['is_use'=>'Y', 'use_main'=>'Y'])->orderby('id', 'desc')->get();

       $event = [];
       foreach( $eventlist as $row){
         $tmp = [];
         $tmp['title'] = $row->title;
         $tmp['pc_image'] = 'https://modoo24.net/'.$row->pc_img;
         $tmp['mobile_image'] = 'https://modoo24.net/'.$row->mobile_img;
         if( $row->external_link){
           $tmp['href'] = $row->external_link;
           $tmp['target'] = true;
         }else{
           $tmp['href'] = "/v2/event/view/".$row->id;
           $tmp['target'] = false;
         }
         $event[] = $tmp;
       }
       $this->makelog($request);
       return view('welcomecsstest', compact(['jisik', 'fun', 'tip','startday','pops','ordergoods','event']));
     }

     public function altest(){
       $origin_sido = ['서울시','경기도','인천시','부산시','대전시','대구시','울산시','세종시','광주시','강원도','충청북도','충청남도','경상북도','경상남도','전라북도','전라남도','제주도'];
       $replace_sido = ['서울','경기','인천','부산','대전','대구','울산','세종','광주','강원','충북','충남','경북','경남','전북','전남','제주'];
       $n = "울산시";
       $res = str_replace( $origin_sido, $replace_sido , $n);

       return;
       $comment = PostComment::find('211');
       event(new CommentEvent( $comment));
       return;
       $review =AuctionBbsPostscript::find('6611')->first();
       event(new ReviewEvent( $review));
       $post = Post::first();
       event(new PostEvent( $post));
return;
       $aligo = new Aligo;

       $req["#{고객명}"] = "성택";
       $req["#{코드}"] = "1132";

       $data = [
         'sender'=>'1600-7728',
         'tpl_code'=>'TC_4365',
         'receiver_1'=>'01025376460',
         'subject_1'=>'모두이사'
       ];
       $aligo->sendKakaoParser($data, $req);
     return;
       $list = $aligo->templateList();
       dd($list);
     }
     public function test(){
       return view("Front.sheettest");

       $client = new Client();
              $url = "https://new.land.naver.com/api/regions/list?cortarNo=0000000000";
$response = $client->request('GET', $url);

       $res = json_decode($response->getBody()->getContents());
       foreach ( $res->regionList as $row){
         dump( $row->cortarNo);
         dump( $row->cortarName);
         dump("=========");
       }
       dd($res);
       return;

       return;
       $comments = PostCommentDepth::get();
       foreach( $comments as $comment){
         $comment->comment = preg_replace('/<(span)\b.*?class=([\'"\s]?)toUser\2.*?>.*?<\/\1>/i', '', $comment->comment);
         $comment->save();
        dump($comment->comment );
       }

       return;
       $post = Post::first();
       event(new PostEvent( $post));
        return;
        $user = User::where(['email'=>'zunme@nate.com'])->first();
        \Event::fire( new Registered($user) );
        new Registered($user);
        //new Event();
     }
    public function index()
    {
      return view('welcome');
      return view('home');
    }

    function makelog(Request $request, $code='home', $step='0', $substep=null, $tranceval = null ){
      $host = parse_url($request->headers->get('referer'), PHP_URL_HOST);
      $referer_str = $request->headers->get('referer');
      if( $request->n_keyword || $request->n_query ){
        $host = "naver_keyword";
        $referer_str = ($request->n_keyword) ? $request->n_keyword : $request->n_query;
      }
      if( !empty($host) && !in_array($host,['xn--pn3bl36b.net','175.123.253.67','modoo24.net','modoo24.com','modooclean.com','24auction.co.kr','www.24auction.co.kr','www.modoo24.net','www.modoo24.com','www.modooclean.com','116.122.157.150']) ){
        \Cookie::queue('referer', $host, 86400);
        //네이버 검색어로 추가
        if ( strstr($host , 'naver.com') ) {
          try{
            parse_str(parse_url($referer_str , PHP_URL_QUERY ), $queryArr );
            if ( isset($queryArr['query']) ) $referer_str = $queryArr['query'];
          }catch (\Exception $e){
              ;
          }
        }
        \Cookie::queue('referer_str', $referer_str , 86400);
      }else {
        $host = $request->cookie('referer') ? $request->cookie('referer') : '';
        //네이버 검색어로 추가
        if ( strstr($host , 'naver.com') ) {
          try{
            parse_str(parse_url($referer_str , PHP_URL_QUERY ), $queryArr );
            if ( isset($queryArr['query']) ) $referer_str = $queryArr['query'];
          }catch (\Exception $e){
              ;
          }
        }
        $referer_str = $request->cookie('referer_str') ? $request->cookie('referer_str') : '';
      }


      $logUnique = $request->session()->get('traceLogId', function () use ($request) {
  			$unique = $this->getUniqueString(10);
  			$request->session()->put('traceLogId', $unique);
  		  return $unique;
  		});
      $agent = new MobileDetect();
   		$mobileResult = $agent->isMobile();
  		try{
        $ins = LaravelTraceLog::create([
					"uniqueId"=>$logUnique,
					"openId"=>'',
					"isMobile"=> $mobileResult ? 'Y':'N',
					"page"=>$code,
					"step"=>$step,
					"substep"=>$substep,
					"ip"=>$request->ip(),
          "referer"=>$referer_str,
          "referer_domain"=> $host
				]);
      }catch( \Exception $e ){
  			return $this->error($e->getMessage());
  		}
  		return $this->success();
    }

    public function home(Request $request){
      $jisik = Post::with(['firstcomment'])->where(['bulletin_id'=>1,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(4)->get();
      $fun = Post::where(['bulletin_id'=>2,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(3)->get();
      $tip = Post::where(['bulletin_id'=>4,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(4)->get();

      $today = Carbon::today()->toDateString();
      $chkMobile = false;

      $notin = [];
      foreach( $_COOKIE as $key =>$val){
        if( $val=='popupviewdone'){
          $tmp = explode( '_', $key);
          if( isset($tmp[2]) ) $notin[] = $tmp[2];
        }
      }
      $startday = Carbon::now()->format('Y-m-d 00:00:00');
      $pops = AuctionPopup::
          where(['bp_use_flag'=>'Y'])
          ->whereNotIn('bp_idx', $notin )
          ->where('bp_start_date','<=',$today )
          ->where('bp_end_date','>=',$today )
          ->get();
      foreach( $pops as &$row){
        $row->pop_w = ($chkMobile) ? ($row->bp_width - 300 ) :($row->bp_width);
        $row->pop_h = ($chkMobile) ? ($row->bp_height - 300 + 76 ) :($row->bp_height+76);
      }

      $ordergoods = MoveGoodsType::with(['items'])->where(['type_use'=>'Y'])->orderBy('type_order_no','asc')->orderBy('id','asc')->get();
      $startday = Carbon::now()->format('Y-m-d 00:00:00');

      if ( $request->testview ) $eventlist = EventList::where([ 'use_main'=>'Y'])->orderby('id', 'desc')->get();
      else $eventlist = EventList::where(['is_use'=>'Y', 'use_main'=>'Y'])->orderby('id', 'desc')->get();

      $event = [];
      foreach( $eventlist as $row){
        $tmp = [];
        $tmp['title'] = $row->title;
        $tmp['pc_image'] = 'https://modoo24.net/'.$row->pc_img;
        $tmp['mobile_image'] = 'https://modoo24.net/'.$row->mobile_img;
        if( $row->external_link){
          $tmp['href'] = $row->external_link;
          $tmp['target'] = true;
        }else{
          $tmp['href'] = "/v2/event/view/".$row->id;
          $tmp['target'] = false;
        }
        $event[] = $tmp;
      }
      $this->makelog($request);
      return view('welcome', compact(['jisik', 'fun', 'tip','startday','pops','ordergoods','event']));
    }

    public function testhome(Request $request){
      $host = parse_url($request->headers->get('referer'), PHP_URL_HOST);
      if( !in_array($host,['modoo24.net','modoo24.com','modooclean.com','24auction.co.kr','www.24auction.co.kr','www.modoo24.net','www.modoo24.com','www.modooclean.com',]) ){
        \Cookie::queue('referer', $host, 86400);
      }
      $jisik = Post::with(['firstcomment'])->where(['bulletin_id'=>1,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(4)->get();
      $fun = Post::where(['bulletin_id'=>2,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(3)->get();
      $tip = Post::where(['bulletin_id'=>4,'is_confirmed'=>'Y', 'main_post'=>'Y'])->orderby('id', 'desc')->limit(4)->get();

      $today = Carbon::today()->toDateString();
      $chkMobile = false;

      $notin = [];
      foreach( $_COOKIE as $key =>$val){
        if( $val=='popupviewdone'){
          $tmp = explode( '_', $key);
          if( isset($tmp[2]) ) $notin[] = $tmp[2];
        }
      }
      $startday = Carbon::now()->format('Y-m-d 00:00:00');
      $pops = AuctionPopup::
          where(['bp_use_flag'=>'Y'])
          ->whereNotIn('bp_idx', $notin )
          ->where('bp_start_date','<=',$today )
          ->where('bp_end_date','>=',$today )
          ->get();
      foreach( $pops as &$row){
        $row->pop_w = ($chkMobile) ? ($row->bp_width - 300 ) :($row->bp_width);
        $row->pop_h = ($chkMobile) ? ($row->bp_height - 300 + 76 ) :($row->bp_height+76);
      }


      $ordergoods = MoveGoodsType::with(['items'])->where(['type_use'=>'Y'])->orderBy('type_order_no','asc')->orderBy('id','asc')->get();

      $startday = Carbon::now()->format('Y-m-d 00:00:00');
      return view('welcometest', compact(['jisik', 'fun', 'tip','startday','pops','ordergoods']));
    }


	    /**
     * CSRF 갱신
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function refresh(Request $request)
    {
        session()->regenerate();
        return response()->json(['result' => 'OK', 'token' => csrf_token()], 200);
    }
}
