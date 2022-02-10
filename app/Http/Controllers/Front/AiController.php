<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use Carbon\Carbon;
use Validator;
use App\Traits\ApiResponser;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Models\OrderAi;

class AiController extends Controller
{
	use ApiResponser;
  function index(Request $request) {
    $messages = [
				'movingtype_ai.*' =>'소형,가정,사무실 이사 중 하나를 선택해주세요',
				'movingmethod_ai.*'=>'(반)포장이사, 일반이사를 선택해주세요',
				'moving-goods-method.*'=>'이사짐량 확인 방법을 선택해주세요',
				'agree_ai.*'=>'AI 러닝 및 구축에 활용됨에 동의해주세요',
		];
		//$data = $this->validate($request, [
		 $this->validate($request, [
			'movingtype_ai' => 'bail|required|in:small,home,office',
			'movingmethod_ai'=>'bail|required|in:packaging,half-packaging,carrying',
			'pyeong_ai'=>'bail|required',
			'agree_ai'=>'bail|required|in:Y,on',
		 ],$messages);
     $this->makedata();

		 try{
			 $uploadefiles = [];
				if($request->hasFile("upload")){
						//foreach ($files as $file) {
					$files = $request->file('upload');
						foreach($files as $file){
							$uploadres = $this->uploadImage( $file );
							if( $uploadres != null ) $uploadefiles[] = $uploadres;
						}
				}
				$data = $request->all();
				$data['images'] = $uploadefiles;
				OrderAi::create( $data );
		 }catch (\Exception $e){
			 return $e->getMessage();
		 }
		sleep( mt_rand(1, 2) );
    return $this->success( $this->pyeong[$request->movingmethod_ai][$request->pyeong_ai]['distance']);
  }
  private function makedata(){
    $half_min_diff = 100000;
    $half_max_diff = 100000;
    $carrying_min_diff = 200000;
    $carrying_max_diff = 200000;
    $this->min_rand = 1020;
    $this->max_rand = 1020;
    $this->distanceArr=[
      'under_30'=>'30km 이하','about_50'=>'50km','about_70'=>'70km','about_100'=>'100km','about_120'=>'120km',
      'about_150'=>'150km','about_170'=>'170km','about_200'=>'200km','about_250'=>'250km','over_250'=>'250km 이상',
    ];
    $this->distance_length = count($this->distanceArr); //거리갯수

    $pyeong =
    [
      'carrying' =>[],
      'half-packaging' =>[],
      'packaging' =>[
        'under_10'=>['min'=>499000, 'max'=>630100],
        'about_10'=>['min'=>650200, 'max'=>810300],
        'about_20'=>['min'=>830000, 'max'=>1050000],
        'about_30'=>['min'=>1070000, 'max'=>1270000],
        'about_40'=>['min'=>1310000, 'max'=>1590000],
        'over_50'=>['min'=>1700000, 'max'=>2250000],
      ],
    ];
    foreach( $pyeong['packaging'] as $id => $row){
      $pyeong['half-packaging'][$id] = ['min'=>$row['min']-$half_min_diff, 'max'=>$row['max']-$half_max_diff];
      $pyeong['carrying'][$id] = ['min'=>$row['min']-$carrying_min_diff, 'max'=>$row['max']-$carrying_max_diff];
    }
    foreach( $pyeong as $idx => &$row){
      $row = $this->makeDistance($row);
    }

    $this->pyeong = $pyeong;
  }
  private function makeDistance($rows){
    foreach( $rows as $idx=>&$row){
      $row['diff'] = $row['max'] - $row['min'];
      $row['perDistance'] = round($row['diff']/$this->distance_length);

      $temp =[];
      $tempVal = $row['min'] - $row['perDistance']*2;

      $i = 1;
      foreach( $this->distanceArr as $idx=>$distance_name){
        $tempVal = ($i == $this->distance_length) ? $row['max'] : $tempVal + ( $row['perDistance'] );
        $temp[] = [
          'title'=>$distance_name,
          //'calc' => $tempVal,
          'val'=> number_format(mt_rand( $tempVal - $this->min_rand, $tempVal + $this->max_rand))
        ];
        $i++;
      }
      $row['distance'] = $temp;

    }
    return $rows;
  }
	private function getGroupNumFromName($name){
		$tmp = explode('_', $name);
		$groupnum = 0;
		if( count($tmp) > 1 ){
				$groupnum = array_shift($tmp);
				$name= pathinfo( implode('_', $tmp) , PATHINFO_FILENAME);
		}
		return ['groupnum'=>$groupnum, "name"=>$name];
	}

	private function uploadImage( UploadedFile $file = null, $id = null){
			if ($file === null) return null;

			try{
				$storage = Storage::disk('public');
				$path = 'order/nface/'.Carbon::now()->format('ymd').'/';
				$gropuname = $this->getGroupNumFromName( $file->getClientOriginalName() );

				$origin = $gropuname['name'] ;
				$groupname = $gropuname['groupnum'] ;

				$image = Image::make($file);

				$ext = $file->getClientOriginalExtension();
				$image_name = Carbon::now()->format('ymdhis') . '_' . Str::random(9) . "." . $ext;

				if (!$storage->exists($path)) {
						$storage->makeDirectory($path, 0775, true);
				}
				$storage->put($path . $image_name, $image->stream()->__toString());
				$size=  $file->getSize();
				$url = '/v2/storage/'.$path . $image_name;
				return [
					'original_name'=> $origin,
					'url'=>$url,
					'groupname'=>$groupname,
				];
			}catch( \Exception $e) {
				return null;
			}
			//return $path . $image_name;
	}
}
