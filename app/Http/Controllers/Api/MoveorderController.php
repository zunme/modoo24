<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use App\Models\MoveGoodsType;
use App\Models\MoveGoods;

class MoveorderController extends Controller
{
	use ApiResponser;
	function index(Request $request){
		
	}
	function goodslist(Request $request){
		$title = '짐정보 선택';
		$list = MoveGoodsType::with(['items'])->where(['type_use'=>'Y'])->orderBy('type_order_no','asc')->orderBy('id','asc')->get();
		return view('Front/Moveorder/goodslist', compact(['title','list']));
		return $this->success(compact(['title','list']));
	}
	
}