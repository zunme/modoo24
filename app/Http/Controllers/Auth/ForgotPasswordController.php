<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

use App\Traits\ApiResponser;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    use ApiResponser;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function password(Request $request){
      $messages = [
          'email.*' => '등록하신 이메일을 적어주세요',
      ];
      $this->validate($request, [
        'email' => 'bail|required|email'
       ],$messages);
       $user = User::where(['email'=>$request->email])->first();

       if( !$user) return $this->error('등록된 이메일을 찾을 수 없습니다.', 422);
       if($user->provider != 'web') return $this->error($user->provider.' 로그인으로 가입하셨습니다', 422);

       $status = Password::sendResetLink(
        $request->only('email'), function ($message){
          $message->subject("모두이사 패스워드 변경");
        }
      );
      if( $status == 'passwords.sent') return $this->success();
      else return $this->error('이메일을 보내지 못했습니다. 잠시후에 사용해주세요', 422);
    }
    private function sendResetEmail($email, $token)
    {
      dd( $email);
    }
    public function sendPasswordResetNotification($token)
    {
      dd( $token);
        $this->notify(new NewResetPassword($token));
    }
}
