<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;
use Carbon\Carbon;

use Validator;
use App\Traits\ApiResponser;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Models\EventList;

class EventController extends Controller
{
	use ApiResponser;
  function eventlist(Request $request){
    $data = EventList::get();
    return Datatables::of($data)->make(true);
  }
  function eventview(Request $request, $id){
		$data = EventList::find($id);
		return $this->success($data);
  }
  function eventsave(Request $request){
    $messages = [
				'title.*' => '제목을 적어주세요.',
        'prc_ing.*' => '분류를 선택해주세요.',
        'duration.*' => '기간을 적어주세요',
    ];
    $this->validate($request, [
			'title'=> 'bail|required|string',
      'prc_ing' => 'bail|required|in:진행중,종료',
      'duration' => 'bail|required|string',
			'external_link'=> 'bail|nullable|url',
     ],$messages);

   if( $request->external_link=='' && $request->desc==''){
     return $this->error('링크 또는 내용을 적어주세요', 422);
   }

    $data = [
			'title'=>$request->title,
      'is_use'=>$request->is_use=='Y' ?'Y':'N',
      'prc_ing'=>$request->prc_ing,
			'prc_ing_sub'=>$request->prc_ing_sub,
      'use_main'=>$request->use_main=='Y' ?'Y':'N',
			'use_list'=>$request->use_list=='Y' ?'Y':'N',
      'duration'=>$request->duration,
      'external_link'=>$request->external_link,
      'desc'=>$request->desc,
    ];

		if ( $request->id ){
			$item =  EventList::find($request->id);
			if( !$item) return $this->error('저장할 데이터를 찾지 못했습니다',422);
			if($data['use_main']=='Y'){
				if( !$request->hasFile('pc_img') || !$request->hasFile('mobile_img')) {
					if( $item->pc_img=='') return $this->error('메인에 노출할 이미지를 선택해주세요', 422);
				}
			}
		}else {
			if($data['use_main']=='Y'){
				if( !$request->hasFile('pc_img') || !$request->hasFile('mobile_img')) return $this->error('메인에 노출할 이미지를 선택해주세요', 422);
			}
			if( !$request->hasFile('list_img') ) return $this->error('리스트에 노출할 이미지를 선택해주세요', 422);
		}

		if($request->hasFile('list_img')){
			$file = $this->uploadImage( $request->file('list_img') );
			$data['list_img'] = $file['url'];
		}
		if($request->hasFile('pc_img')){
			$file = $this->uploadImage( $request->file('pc_img') );
			$data['pc_img'] = $file['url'];
		}
		if($request->hasFile('mobile_img')){
			$file = $this->uploadImage( $request->file('mobile_img') );
			$data['mobile_img'] = $file['url'];
		}
		if ( $request->id){
			try{
				$data['desc'] = $this->getImage($data['desc']);
				$item->update($data);
			}catch(\Exception $e){
				return $this->error( $e->getMessage());
			}
		}else{
			try{
				$data['desc'] = $this->getImage($data['desc']);
				$userinfo = $this->userinfo();
				$data['writer'] = $userinfo['name'];
				EventList::create($data);
			}catch(\Exception $e){
				return $this->error( $e->getMessage());
			}
		}
		return $this->success();
  }

	private function uploadImage( UploadedFile $file = null)
		{
				if ($file === null) return null;


				$storage = Storage::disk('public');
				$path = 'event/'.Carbon::now()->format('ymd').'/';

				$image = Image::make($file);
				$image_name = $this->generateFileName($file);
				if (!$storage->exists($path)) {
						$storage->makeDirectory($path, 0775, true);
				}

				$storage->put($path . $image_name, $image->stream()->__toString());

				$size=  $file->getSize();
				$origin =  $file->getClientOriginalName() ;
				$url = '/'.$path . $image_name;
				return [
					'original_name'=> $origin,
					'url'=>'/community/storage'.$url,
					'attach_type'=> 'image',
					'attach_size'=>$size,
				];
				//return $path . $image_name;
		}
		private function generateFileName(UploadedFile $file)
    {
        $ext = $file->getClientOriginalExtension();
        return Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $ext;
    }
		private function getImage($body){
					$dom = new \DOMDocument();
					@$dom->loadHtml('<?xml encoding="utf-8"?>' . $body , LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD | LIBXML_NOXMLDECL);
					$dom->encoding = 'utf-8';
					$images = $dom->getElementsByTagName('img');
					$images_arr = [];
					foreach ($images as $img) {
							array_push($images_arr, $img->getAttribute('src'));
					}

					$storage = Storage::disk('public');
					$path = 'event/' . Carbon::now()->format('ymd') . '/';
					$defaultStartUrl = '/community/storage/';

					try {
							if (count($images) > 0) {
									foreach ($images as $k => $img) {
											$image_64 = $img->getAttribute('src');
											if (strpos($image_64, ';base64')) {
													$image_data_aux = explode(';base64', $img->getAttribute('src'));
													$image_data = $image_data_aux[1];
													$extension = explode('/', $image_data_aux[0])[1];
													$imageName = Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $extension;
													$storage->put($path . $imageName, base64_decode($image_data));
													$img->removeAttribute('src');
													$img->setAttribute('src', $defaultStartUrl . $path . $imageName);
											} else {
													continue;
											}
									}
							}

					} catch (\Exception $e) {
							return response()->json(['errors' => ['system' => ['시스템 오류입니다.'], 'e' => $e, 'data' => $request->all()]], 422);
					}

					/*$returnBody = Str::of($dom->saveHTML())->replace('<?xml encoding="utf-8"?>','');		*/
					return  substr(trim(str_replace('<?xml encoding="utf-8"?>', '', $dom->saveHTML())) ,119,-14);
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
