<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Libraries\MobileDetect;

class HomeController extends Controller
{
	public function index(Request $request){
		$agent = new MobileDetect();
 		$mobileResult = $agent->isMobile();

		return view('admin/jisik');
	}
}
?>
