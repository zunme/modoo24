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

}