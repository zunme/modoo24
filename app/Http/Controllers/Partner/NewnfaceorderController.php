<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\AuctionOrderNface;

use App\Traits\ApiResponser;

class NewnfaceorderController extends Controller
{
  use ApiResponser;

  public function getInfo($id){
    /* TODO */
    //$uid =8;
    $data = AuctionOrderNface::where(['uid'=>$id])->first();

    if( !$data) return $this->error('데이터가 없습니다!', 404);
    else return $this->success( $data);
  }

}
?>
