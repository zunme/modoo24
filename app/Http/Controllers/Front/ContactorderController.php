<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\Models\BulletinSidoCopy;
use App\Models\AuctionOrder;

class ContactorderController extends Controller
{
	use ApiResponser;
  public function step1(Request $request){

    $res = $this->stepCarryingMethodCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);

    //$this->makelog($request, 'contactpop', '2' );
    return $this->success( );
  }


  //이사종류 체크
  private function stepCarryingMethodCheck($request){
    $messages = [
        'movingtype.*' =>'가정, 소형원룸, 사무실 이사 중 하나를 선택해주세요',
        'use_container.*'=>'보관이사 여부를 선택해주세요',
    ];
    //$data = $this->validate($request, [
    $validator = Validator::make($request->all(),[
      'movingtype' => 'bail|required|in:small,home,office',
      'use_container'=>'bail|nullable|in:Y,on',
     ],$messages);
     if ($validator->fails()) return $validator->messages()->first();
     else return true;
  }
}
