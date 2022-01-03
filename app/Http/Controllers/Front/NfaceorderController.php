<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use App\User;


class NfaceorderController extends Controller
{
	use ApiResponser;
  function step1(Request $request){
		/*step1 check */
    $res = $this->stepAddressCheck($request);
    if( $res !== true) return $this->error($res,422,['step'=>1]);
		/*end step1 check */

    return $this->success( $this->tranceData( $request->all() ));
  }

  private function stepAddressCheck(Request $request ){
    $messages = [
        's_addr1.*' =>'출발지 주소를 검색해주세요',
        's_zip1.*' =>'출발지 주소를 검색해주세요',
        's_addr2.*' =>'출발지 상세주소를 적어주세요',

        's_pyeong.*' =>'출발지의 평수를 적어주세요',
        's_floor.*' =>'출발지의 층수를 적어주세요',

        'e_addr1.*' =>'도착지 주소를 검색해주세요',
        'e_zip1.*' =>'도착지 주소를 검색해주세요',
        'e_pyeong.*' =>'도착지의 평수를 적어주세요',
        'e_floor.*' =>'도착지의 층수를 적어주세요',
    ];
    //$data = $this->validate($request, [
		$validator = Validator::make($request->all(),[
      's_addr1' => 'bail|required|string',
      's_zip1'=> 'bail|required|numeric',
      's_addr2' => 'bail|required|string',
      's_pyeong'=>'bail|required|numeric',
      's_floor'=>'bail|required|numeric',

      's_ev_no'=>'bail|nullable|in:Y,on',
      's_park_no'=>'bail|nullable|in:Y,on',

      'e_addr1' => 'bail|required|string',
      'e_zip1'=> 'bail|required|numeric',
      'e_pyeong'=>'bail|required|numeric',
      'e_floor'=>'bail|required|numeric',

      'e_ev_no'=>'bail|nullable|in:Y,on',
      'e_park_no'=>'bail|nullable|in:Y,on',
     ],$messages);
		 if ($validator->fails()) return $validator->messages()->first();
		 else return true;
  }
	private function tranceData($data){
		$checkoption = ['s_ev_no', 's_park_no','e_ev_no', 'e_park_no'];
		foreach ( $checkoption as $opt){
			$data[$opt] = ( !isset($data[$opt]) ||  !in_array($data[$opt], ['Y','on']) ) ? 'N': 'Y';
		}
		return $data;
	}
}
