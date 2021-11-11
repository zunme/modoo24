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
		$data = User::withTrashed()->select('*');
		return Datatables::of($data)->make(true);
	}
	function userCreate( Request $request ){
		$messages = [
				'email.unique' => '이미 사용중인 이메일입니다.',
        'email.*' => '유저 이메일을 확인해주세요.',
				'nickname.*' => '닉네임이 필요합니다.',
				'newpassword.*' => '4~20자 내외로 패스워드를 적어주세요.',
				'level.*' => '유저상태가 필요합니다.',
				'simplyMarketting.*' => '마케팅 동의여부를 확인해주세요.',
				'phone.*' => '전화번호는 숫자만넣어주세요.',
    ];
		$this->validate($request, [
			'nickname' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'newpassword' => 'required|string|min:4|max:20',
			'level'=> 'bail|required|in:100,1000',
			'simplyMarketting'=> 'bail|required|in:Y,N',
			'phone' => 'bail|nullable|numeric',
     ],$messages);
		 $data = $request->all();
		 $data['name'] =$data['nickname'];
		 $data['password'] = \Hash::make($request->newpassword);
		 try{
			 	$user = User::create($data);
				return $this->success( );
			} catch ( \Exception $e){
				return $this->error('유저생성에 실패하였습니다.',422, $e);
			}
	}
	function userInfoChange( Request $request){
		$messages = [
        'id.*' => '유저 아이디가 필요합니다.',
				'nickname.*' => '닉네임이 필요합니다.',
				'user_status.*' => '유저상태가 필요합니다.',
				'phone.*' => '전화번호는 숫자만넣어주세요.',
    ];
    $this->validate($request, [
      'id' => 'bail|required|numeric',
			'nickname' => 'bail|required|string|max:20',
			'user_status'=> 'bail|required|in:normal,withdrawal,companyId,pass',
			'phone' => 'bail|nullable|numeric',
     ],$messages);
		$user = User::withTrashed()->find( $request->id);
		if( !$user ) return $this->error('유저를 찾을 수 없습니다.', 422);
		$update['nickname'] = $request->nickname;
		$update['phone'] = $request->phone;
		$update['reasonWithdrawal'] = $request->reasonWithdrawal;
		if($request->newpassword ){
			$update['password']= \Hash::make($request->newpassword);
		}
		switch( $request->user_status){
				case  'normal' :
					$update['deleted_at'] = null;
					$update['level'] = 100;
				break;
				case  'withdrawal' :
					$update['deleted_at'] = Carbon::now();
				break;
				case  'companyId' :
				$update['deleted_at'] = null;
				$update['level'] = 1000;
				break;
		}
		try{
			$user->update($update);
			return $this->success( );
		} catch ( \Exception $e){
			return $this->error('상태변경에 실패하였습니다.',422, $e);
		}
	}
}
