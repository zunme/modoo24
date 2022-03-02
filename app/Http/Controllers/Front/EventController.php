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
use App\Models\EventList;

class EventController extends Controller
{
	use ApiResponser;
  public function index(Request $request){
			if ($request->testview) $data = EventList::where(['use_list'=>'Y'])->orderby('prc_ing','asc')->orderby('id','desc')->get();
			else $data = EventList::where(['is_use'=>'Y','use_list'=>'Y'])->orderby('prc_ing','asc')->orderby('id','desc')->get();

      return view('Front/Event/eventlistv2',compact(['data']));
  }
  public function viewdetail ( Request $request, $code ){
    return view('Front/Event/detail'.$code);
  }
	public function viewevent(Request $request, $id){
		if ($request->testview) $data = EventList::where(['id'=>$id])->first();
		else $data = EventList::where(['id'=>$id, 'is_use'=>'Y'])->first();

		if( !$data ){
			return redirect('/event');
		}else{

			if( $data->loadexternal){
				;
			}else if ( $data->external_link ){
				return redirect('/event');
			}

			$data->view_cnt = $data->view_cnt+1;
			$data->save();

			$before_data =  EventList::where(['is_use'=>'Y'])->where("id","<",$id)->orderby('id','desc')->first();
			$after_data =  EventList::where(['is_use'=>'Y'])->where("id",">",$id)->orderby('id','asc')->first();

			return view('Front/Event/eventview', compact(['data','before_data','after_data']));
		}
	}
	public function linkcount(Request $request, $id){
		if ($request->testview) $data = EventList::where(['id'=>$id])->first();
		else $data = EventList::where(['id'=>$id, 'is_use'=>'Y'])->first();

		if( !$data ){
			return redirect('/event');
		}else{

			if( $data->loadexternal){
				;
			}else if ( $data->external_link ){
				return redirect('/event');
			}
			$data->counts = $data->counts+1;
			$data->save();

			return view('Front/Event/linkcount', compact(['data']));
		}
	}
}
