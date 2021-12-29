<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Traits\ApiResponser;

use App\Models\SiteConfig;
//use App\Http\Libraries\MobileDetect;

class SiteconfigController extends Controller
{
  use ApiResponser;

  function index(Request $request){
    $siteconfigs = SiteConfig::get();
    return view('admin/siteconfigs', compact(['siteconfigs']));
  }
  function store(Request $request){
    $messages = [
        'code.*' =>'CONFIG 코드값을 적어주세요.',
        'config_id_1.*' =>'INDEX명을 적어주세요',
        'config_val_1.*' =>'코드의 값을 적어주세요',
    ];
    $this->validate($request, [
      'code'=>'bail|required|string',
      'config_id_1'=>'bail|required|string',
      'config_val_1'=>'bail|required|string',
    ],$messages);
    $data = $request->all();
    $code_value= array();
    for ($i = 1 ; $i <= $request->rownum; $i++){
      if( isset($data['config_id_'.$i]) && !empty($data['config_id_'.$i])){
        if ( !isset($data['config_val_'.$i]) || empty($data['config_val_'.$i]) ) return $this->validatormessage('config_val_'.$i , '값을 입력해주세요');
        $tmp = array();
        $tmp['id'] = $data['config_id_'.$i];
        $tmp['val'] = $data['config_val_'.$i];
        $tmp['desc'] = ( isset($data['config_desc_'.$i]) && !empty($data['config_desc_'.$i])) ? $data['config_desc_'.$i] : '';
        $code_value[] = $tmp;
      }
    }

    $item = SiteConfig::create([
      'code'=>$request->code,
      'code_desc'=>$request->code_desc,
      'code_value'=>$code_value,
    ]);
    \Cache::flush();
    return $this->success();
  }

  function itemstore(Request $request){
    $messages = [
        'id.*' =>'CONFIG 코드값을 적어주세요.',
        'ind.*' =>'INDEX명을 적어주세요',
        'val.*' =>'코드의 값을 적어주세요',
    ];
    $this->validate($request, [
      'id'=>'bail|required|numeric',
      'ind'=>'bail|required|string',
      'val'=>'bail|required|string',
      'desc'=>'bail|nullable|string',
    ],$messages);

    $cfg = SiteConfig::find($request->id);
    $data =[];
    foreach( $cfg->code_value as $row){
      if( $row['id'] == $request->ind ){
        $row['val'] = $request->val;
        $row['desc'] = $request->desc;
      }
      $data[] = $row;
    }
    $cfg->code_value = $data;
    $cfg->save();
    \Cache::flush();
    return $this->success();
  }
}
?>
