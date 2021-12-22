<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use App\Models\AdminPusher;

class PusherController extends Controller
{
  use ApiResponser;
  function store(Request $request){
    $userinfo = $this->userinfo();
    if( !$userinfo) return $this->error("로그인후 사용해주세요", 401);
   $this->validate($request, [
     'token' => 'required|string',
   ]);
   $token = AdminPusher::where( ['admin_id'=>$userinfo['id'], 'token'=>$request->token ])->first();
   if(!$token) {
     AdminPusher::create([
       'admin_id'=>$userinfo['id'],
       'token'=>$request->token
     ]);
   }
   return $this->success();
  }
  private function userinfo(){
    session_start();
    $session =  $_SESSION;
    session_write_close();
    if( !isset ( $session['ad_idx'] ) ) return false;
    else return [
      'id'=>$session['ad_idx'],
      'level'=>$session['ad_level'],
      'name'=>$session['ad_name']
    ];
  }
}
