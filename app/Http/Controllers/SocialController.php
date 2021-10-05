<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth; 
use Socialite;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SocialController extends Controller
{
	use AuthenticatesUsers;
	
	function redirect(Request $request, $provider){
		if (! array_key_exists($provider, config('services'))) {
			return $this->sendNotSupportedResponse($provider);
		}
		return Socialite::driver($provider)->redirect();
	}
	function Callback(Request $request, $provider) {
		$socialUser = Socialite::driver($provider)->user();

		if( $socialUser->getEmail() ){
			$email = $socialUser->getEmail();
		}else $email = $socialUser->getId().'@'.$provider.'.provider';

		if ($user = User::where('email', $email )->first()) {
            $this->guard()->login($user, true);
            //return $this->sendLoginResponse($request);
        }else {
			$data = $socialUser->getRaw();
			$data['email'] = $email;
			$data['password'] = 'provider';
			$data['provider'] = $provider;
			
			if ( $socialUser->getNickname() ) {
				$data['nickname'] = $socialUser->getNickname();
				if ( $socialUser->getName() ) $data['name'] = $socialUser->getName();
				else $data['name'] = $socialUser->getNickname();
			}
			if ( $socialUser->getName() ) {
				$data['name'] = $socialUser->getName();
				if ( $socialUser->getNickname() ) $data['nickname'] = $socialUser->getNickname();
				else $data['nickname'] = $socialUser->getName();
			}

			event(new Registered($user = User::create( $data )));

			$user->remember_token = Str::random(60);
			$user->save();

			$this->guard()->login($user, true);	
		}
		return $this->sendLoginResponse($request);
	}

    protected function authenticated(Request $request, User $user)
    {
        flash()->success(__('auth.welcome', ['name' => $user->name]));
    }

    /**
     * 지원하지 않는 소셜 공급자에 대한 응답입니다.
     *
     * @param string $provider
     * @return RedirectResponse
     */
    protected function sendNotSupportedResponse(string $provider)
    {
        flash()->error(trans('auth.social.not_supported', ['provider' => $provider]));

        return back();
    }	
}
