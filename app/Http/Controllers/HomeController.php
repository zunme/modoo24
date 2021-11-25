<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Events\Registered;
use App\Events\Event;
use App\Events\PostEvent;
use Validator;
use App\User;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostCommentDepth;
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
       $aligo = new Aligo;
       $msg =[
         'sender'=>'1600-7728',
         'tpl_code'=>'TG_0107',
         'receiver_1'=>'01025376460',
         'subject_1'=>'모두이사',
         'message_1'=>"[모두이사]
태기님  모두이사를 방문해 주셔서 감사합니다.

이사업체 알아보기 번거롭다면?
모두이사에서 이사 견적 신청으로 해결하세요!

▶간편한 견적 확인
30초 이사 견적 신청으로 우수 이사업체의 이사 견적을 확인하세요

▶믿을 수 있는 업체 연결
업체별 평가등급과 이사 후기, 사업자등록증 정보를 확인하세요

※모두이사 마케팅 활용 동의 고객님에 한해 단 1회 전달되는 알림톡입니다. 필요시, 전화 상담이 진행될 수 있습니다.

☎고객만족센터 1600-7728",
       ];
       $res =  $aligo->sendTok($msg);
       if( $res['code']=='validator') return response()->json($res['validator']->messages(), 422);

       return;
       $list = $aligo->templateList();
       dd($list);
     }
     public function test(){
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
       return view("Front.sheettest");
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

      $startday = Carbon::now()->format('Y-m-d 00:00:00');
      return view('welcome', compact(['jisik', 'fun', 'tip','startday']));
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
