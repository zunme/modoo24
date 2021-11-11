<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Registered;
use App\Events\Event;
use App\Events\PostEvent;
use Validator;
use App\User;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostCommentDepth;
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
     public function test(){
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
