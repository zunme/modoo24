<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\AuctionStaff;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

class StaffController extends Controller
{
	use ApiResponser;
	function staffInfo( Request $request){
		$messages = [
        'id.*' => '유저 아이디가 필요합니다.',
    ];
    $this->validate($request, [
      'id' => 'bail|required|numeric',
     ],$messages);
		$user = AuctionStaff::with(['commentlogs'])->find( $request->id);
		if( !$user ) return $this->error('유저를 찾을 수 없습니다.', 422);
		return $this->success( $user );
	}
	function statics(  Request $request ){
		//$statics = $this->allStatics();
		$statics = $this->communityStatics();

		$user = AuctionStaff::with(['commentlogs'=>function($q){
			$q->whereRaw("created_at >=DATE_FORMAT( DATE_SUB( NOW(), INTERVAL 6 MONTH), '%Y-%m-%d 00:00:00')");
		}])->where('s_level','>',0);
		return Datatables::of($user)
		->addColumn( 'grade', function ($user) use($statics) {
			if( isset($statics["_".$user->s_uid]) ) $total = $statics[ "_".$user->s_uid ]->cnt;
			else $total=0;
			return $this->communityGradeTitle($total);
		})
		->addColumn( 'totalBestCount', function ($user) use($statics) {
			if( isset($statics["_".$user->s_uid]) ) return $statics[ "_".$user->s_uid ]->cnt;
			else return 0;
		})
		->make(true);
	}

}
