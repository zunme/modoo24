<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Events\Registered;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/community/posts/jisik';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout()
    {
      \Auth::logout();
    }
		public function showLoginForm()
		{
				session(['link' => url()->previous()]);
				return view('auth.login');
		}
		protected function authenticated( $request)
		{

      if (\Auth::user()->confirmed_at == null) {
            $user =  \Auth::user();
            \Event::fire( new Registered( $user) );
            auth()->logout();
            return back()->with('warning', '이메일인증이 필요합니다.<br>이메일로 인증코드를 재발송했으니 이메일을 확인해주세요');
        }
			return redirect(session('link'));
		}
}
