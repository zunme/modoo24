<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use App\Http\Libraries\MobileDetect;
/* TODO */
use App\Models\AuctionOrderNface;

use App\Traits\ApiResponser;
class NewnfaceorderController extends Controller
{
  use ApiResponser;

  public function getInfo($uid){
    /* TODO */
    //$uid =8;
    $data = AuctionOrderNface::where(['uid'=>$uid])->first();

    if( !$data) return $this->error('데이터가 없습니다', 404);
    else return $this->success( $data);
  }
}
?>
