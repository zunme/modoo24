<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\AuctionBbsPostscript;
use App\Models\ReviewFile;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;

use App\Traits\ApiResponser;

class AuctionstaffController extends Controller
{
	use ApiResponser;
  function reviewfiles(Request $request, $s_uid){
    $files = AuctionBbsPostscript::
      select('review_files.*')
      ->where(['b_worker_idx'=>$s_uid])
      ->join('review_files', 'auction_bbs_postscript.b_uid','=','review_files.review_id' )
      ->get();
    return $this->success( compact(['files']));
  }
}
