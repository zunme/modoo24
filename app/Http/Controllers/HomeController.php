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

use App\Models\AuctionBbsPostscript;

use App\Libraries\Aligo;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class HomeController extends Controller
{
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
     public function altest(){
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
    public function home(){
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

      $startday = Carbon::now()->format('Y-m-d 00:00:00');
      return view('welcome', compact(['jisik', 'fun', 'tip','startday','pops']));
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
