<?
namespace App\Libraries;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Validator;

/*
use App\Libraries\Aligo;

$aligo = new Aligo;

$req["#{고객명}"] = "성택";
$req["#{코드}"] = "1132";

$data = [
  'sender'=>'1600-7728',
  'tpl_code'=>'TC_4365',
  'receiver_1'=>'01025376460',
  'subject_1'=>'모두이사'
];
$aligo->sendKakaoParser($data, $req);
*/
class Aligo {
    public function __construct() {
      $this->aligo_kakao_id = 'modoo24';
  		$this->aligo_key = 'jqcikv92tvfqk0obiof3skpuk6w1chp2';
  		$this->aligo_send_key = 'b724997843be5e7009ec283489148df157c813c7';
      $this->base_url ="https://kakaoapi.aligo.in";
      $this->params = [
        'apikey' =>	$this->aligo_key,
        'userid' => $this->aligo_kakao_id,
        'senderkey'=> $this->aligo_send_key,
        'token'=>null
      ];
      $this->client = new Client(['base_url'=>  $this->base_url]);
    }
    public function token(){
        $client = new Client(['base_url'=>  $this->base_url]);
        $params = [
          'apikey' =>	$this->aligo_key,
          'userid' => $this->aligo_kakao_id
        ];
        $response = $client->request('POST',   $this->base_url.'/akv10/token/create/30/s/', [
          'form_params' => $params,
        ]);
        $res = json_decode($response->getBody()->getContents());
        if ($res->token) {
          $this->params['token'] = $res->token;
          return $res->token;
        }
        else return false;
    }

    public function sendKakaoParser($data, $req){

      if ( !isset($data['sender']) || $data['sender'] == '' ) $data['sender'] ='1600-7728';
      if ( !isset($data['subject_1']) || $data['subject_1'] == '' ) $data['subject_1'] ='모두이사';
      if ( !isset($data['receiver_1']) || $data['receiver_1'] == '' ) return false;
      if ( !isset($data['tpl_code']) || $data['tpl_code'] == '' ) return false;

      $templates = $this->templateList();
      if( !isset($templates[$data['tpl_code']]) ) {
        \Cache::forget('kakaoTemplateList');
        $templates = $this->templateList();
      }
      $template = $templates[$data['tpl_code']];

      if ( count($template['contentVars']) != count( $req) ) {
        return false;
      }
      $tplstr = $template['template']->templtContent;
      $buttons = $template['template']->buttons;

      //치환
      if( count($template['contentVars']) > 0){
        $search = array_keys( $req );
        $replace = array_values( $req );
        $data['message_1'] = str_replace( $search, $replace, $tplstr);
        $buttonStr = '';
        if( count($buttons)>0 ){
          $newbutton['button'] = [];
          foreach( $buttons as $idx=> $row){
            $btn = [];
            foreach ( $row as $idx=>$val){
              if ( $idx =='name') $btn['name'] = $val;
              else if ( $idx =='linkType') $btn['linkType'] = $val;
              else if ( $idx =='linkPc' && $val !='') $btn['linkP'] = $val;
              else if ( $idx =='linkMo' && $val !='') $btn['linkM'] = $val;
              else if ( $idx =='linkIos' && $val !='') $btn['linkI'] = $val;
              else if ( $idx =='linkAnd' && $val !='') $btn['linkA'] = $val;
            }
            $newbutton['button'][] = $btn;
          }
          $data['button_1'] =str_replace( $search, $replace, json_encode($newbutton, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) );
        }
      }
      return $this->sendTok($data);
    }

    //단건으로만 만들었음
    public function sendTok($data){
      $this->token();

      $response = $this->client->request('POST',   $this->base_url.'/akv10/alimtalk/send/', [
        'form_params' => array_merge($this->params, $data),
      ]);
      $res = json_decode($response->getBody()->getContents());
      //dump( $res);
      return true;
      $validator = Validator::make($data, [
          "tpl_code"    => "required|string|min:1",
          "sender"    => "required|numeric|min:1",
          "receiver_1 "    => "required|string|min:1",
          "subject_1 "    => "required|string|min:1",
          "message_1"    => "required|string|min:1",
      ]);
      if ($validator->fails())
      {
        return ["code"=>'validator','msg'=>'필요데이터가 없습니다.',"validator"=>$validator];
      }

      return;
    }
    public function templateList() {
       //\Cache::forget('kakaoTemplateList');
      $data = \Cache::remember('kakaoTemplateList', 60*60*48, function () {
        $this->token();
        $response = $this->client->request('POST',   $this->base_url.'/akv10/template/list/', [
          'form_params' => $this->params,
        ]);
        $res = json_decode($response->getBody()->getContents());
        $tpllist = $this->parseTemplate( $res);
        return $tpllist;
      });
      return $data;
    }
    private function parseTemplate($res){
      $ret = [];
      foreach ( $res->list as $row){
        preg_match_all('/#{.*}/', $row->templtContent, $matches);
        $matchval = ( isset($matches[0]) ) ? $matches[0] : null;
        foreach(  $row->buttons as $button){
          foreach( $button as $idx=>$val){
            preg_match_all('/#{.*}/', $val, $matches);
            $temp = ( isset($matches[0]) ) ? $matches[0] : null;
            if( $temp ) {
              $matchval = array_merge($matchval, $temp);
            }
          }
        }
        $vals =[];
        foreach( $matchval  as $val ){
          $vals[$val] = $val;
        }
        $temp = ["contentVars"=>$vals, "template"=>$row];
        $ret[$row->templtCode] = $temp;
      }
      return $ret;
    }
}
