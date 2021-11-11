<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Traits\ApiResponser;


class EventController extends Controller
{
	use ApiResponser;
  public function index(){
      return view('Front/Event/eventlist');
  }
  public function viewdetail ( Request $request, $code ){
    return view('Front/Event/detail'.$code);
  }
}
