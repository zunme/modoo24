<?php

namespace App\Http\Controllers\External;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use App\Traits\ApiResponser;

/* TODO */
use App\Models\AuctionOrderNface;


class InternetController extends Controller
{
	  use ApiResponser;
    public function __construct(){
      $this->users = [
        'externalId1'=>'llsdo0304'
      ];
    }
	  function index(Request $request){
      if( !$request->session()->has('ExternalAuth') ){
        if( $request->userid && $request->password){
            if( isset($this->users[ $request->userid ] ) && $this->users[ $request->userid ] == $request->password ){
              $request->session()->put('ExternalAuth', [ 'eAuthId'=> $request->userid ]);
            }else return \Redirect::back()->withErrors(['msg' => '아이디와 패스워드를 확인해주세요'])->withInput($request->except("password"));
        }
        else return view('External.login');
      }
      return $this->internetlist($request);
    }
    function internetlist(Request $request){
        $data = AuctionOrderNface::where(['s_uid'=>'0'])
        ->where('name', 'not like', "%테스트%")
        ->where('name', 'not like', "%삭제%")
        ->orderBy('reg_date','desc')->paginate(20);
        return view('External.internetlist', compact(['data']));
    }
		private function format_tel($tel) {
    $tel = preg_replace('/[^0-9]/', '', $tel);
	    return preg_replace('/(^02.{0}|^01.{1}|^15.{2}|^16.{2}|^18.{2}|[0-9]{3})([0-9]+)([0-9]{4})/', '$1-$2-$3', $tel);
		}
}
