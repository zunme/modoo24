<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\Post;
use App\Models\AuctionStaff;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;


class UserController extends Controller
{
	use ApiResponser;
	function userInfo( Request $request){
		$messages = [
        'id.*' => '유저 아이디가 필요합니다.',
    ];
    $this->validate($request, [
      'id' => 'bail|required|numeric',
     ],$messages);
		$user = User::withTrashed()->find( $request->id);
		if( !$user ) return $this->error('유저를 찾을 수 없습니다.', 422);
		else {
			$cnt = Post::where(['user_id'=>$user->id])->where('is_confirmed', '!=', 'N')->count();
			$user['post_count'] = $cnt;
			return $this->success( $user );
		}
	}
	function usersList( Request $request ){
		$data = User::select('*');
		return Datatables::of($data)->make(true);
	}
}