<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Validator;

use App\Traits\ApiResponser;

class PushcheckController extends Controller
{
	use ApiResponser;
  function checklist(Request $request){
    dd( $request);
  }
}
