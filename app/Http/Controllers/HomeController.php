<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\Registered;
use App\Events\Event;
use App\Events\PostEvent;
use Validator;
use App\User;

use App\Models\Post;

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
       $post = Post::first();
       event(new PostEvent($post));
        return;
        $user = User::where(['email'=>'zunme@nate.com'])->first();
        \Event::fire( new Registered($user) );
        new Registered($user);
        //new Event();
     }
    public function index()
    {
        return view('home');
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
