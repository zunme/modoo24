<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return  User::create([
          'name' => $data['name'],
          'nickname'=>$data['name'],
          'email' => $data['email'],
          'provider'=>'web',
          'password' => bcrypt($data['password']),
          'confirmation_token' => User::generateToken(),
        ]);
        \Event::fire( new Registered($user) );
        return $user;
    }
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        \Event::fire( new Registered($user) );
        return redirect('/login')->with('warning', '이메일인증이 필요합니다.<br>이메일로 인증코드를 발송했으니 이메일을 확인해주세요');
    }
    public function confirm($user, $token) {
      $user = User::where(['email'=>$user])->first();
        if( !$user){
          $message = '가입된 이메일을 찾을 수 없습니다.';
        }
        else if( $user->confirmed_at != null ){
          $message = '이미 인증된 이메일 입니다.<br>로그인후 사용해주세요';;
        }
        else if ($user->confirm($token)) {
            $message = '이메일 인증이 완료되었습니다.<br>로그인후 사용해주세요';
        } else {
            $message = '토큰정보가 잘못되었습니다.<br>이메일로 인증코드를 재발송하였으니 이메일을 확인해주세요';
            \Event::fire( new Registered($user) );
        }
        return redirect('/login')->with('warning', $message);
    }
}
