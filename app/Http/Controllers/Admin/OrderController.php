<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Models\AuctionOrder;
use App\Models\AuctionOrderNface;
use App\Models\AuctionCallList;

use App\Models\AuctionOrderInfoEnc;

use App\Events\OrderuserinfodeletedEvent;

use App\Traits\ApiResponser;

class OrderController extends Controller
{
  use ApiResponser;

  function deleteUserInfo(Request $request){

    $messages = [
        'id.*' => 'id값이 필요합니다.',
        'type.*' =>'이사,비대면 구분이 필요합니다',
    ];
    $this->validate($request, [
      'id' => 'bail|required',
      'type' => 'bail|required|in:order,nface',
     ],$messages);

      $id = $request->id;

      $admin = $this->userinfo();
      if( !$admin){
        return $this->error("로그인후 사용해주세요", 401);
      }

      $cnt = AuctionOrderInfoEnc::where(['order_id'=>$id , 'order_type'=>$request->type])->count();
      if( $cnt > 0 ){
        return $this->error('이미 정보삭제 처리되었습니다.', 409 );
      }
      if($request->type=='order') {$order = AuctionOrder::find($id);}
      else $order = AuctionOrderNface::find($id);

      if(!$order){
        return $this->error("오더정보를 찾을 수 없습니다.", 404);
      }

      

      $ins = [
        'admin_id'=> $admin['id'],
        'admin_name'=> $admin['name'],
        'order_id'=> $id,
        'order_type'=>$request->type,
        'name'=>encrypt($order->name),
        'phone'=>encrypt($order->hp),
      ];

      \DB::beginTransaction();
  		try{
        $deleteuserinfo = AuctionOrderInfoEnc::create($ins);
        $order->name = '고객정보삭제';
        $order->hp = '고객정보삭제';
        $order->save();
	
	if($request->type != 'order'){
		$call = AuctionCallList::where(['uid'=>$id])->update([ 'send_number' => '고객정보삭제', 'get_number' => '고객정보삭제' ]);
	}

        \DB::commit();
      }catch ( \Exception $e){
  			\DB::rollback();
        $errorCode = $e->errorInfo[1];
        if($errorCode == 1062){
            return $this->error('이미 정보삭제 처리되었습니다.', 422, $e->getMessage() );
        }else return $this->error('잠시 후에 이용해주세요.', 422, $e->getMessage() );
  		}
      event(new OrderuserinfodeletedEvent( $deleteuserinfo ));
      return $this->success($order);
  }
  function deleteUserList(Request $request){

    event(new OrderuserinfodeletedEvent( AuctionOrderInfoEnc::find(8) ));
    event(new OrderuserinfodeletedEvent( AuctionOrderInfoEnc::find(10) ));

    $list = AuctionOrderInfoEnc::paginate(10);
    foreach( $list as &$row){
      $row->phone= decrypt($row->phone);
      $row->name= decrypt($row->name);
    }
    dump( $list);
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
?>
