<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Illuminate\Notifications\Notifiable;
class NewCleanOrder extends Model
{
	use SoftDeletes;
	//use Notifiable;
  protected $table = 'clean_orders';
  protected $fillable = [
    'order_status','contract_id','stype'
    ,'register_name','register_phone','del_userinfo'
    ,'mdate','negotiable'
    ,'s_bcode','s_sigunguCode','s_zip1','s_addr1','s_addr2'
    ,'s_pyeong','s_floor','clean_building','clean_space','options','nooption'
    ,'spacenums','agree1','agree2','agree_marketing'
    ,'files','memo','admin_memo'
  ];
  protected $hidden = ['register_name', 'register_phone'];
  protected $appends = ['building_type','user_name','user_phone','formated_phone'];
  protected $casts = ['options'=>'object','spacenums'=>'object','files'=>'object','admin_memo'=>'object'];
  /*
  스마트인잡 - '제공','제공대기','제공완료'
  업체노출금지 -'상담전','업체노출금지'
  업체노출 - '상담대기','견적완료','견적마감','계약완료'
  업체견적가능 ?? : '상담대기','견적완료','견적마감' + mdate 이전
  */
  public function scopeActive($query){
        return $query->whereIn('order_status', ['상담대기','견적완료','견적마감','계약완료']);
  }
  public function getBuildingTypeAttribute() {
    $type = ['stype_1'=>'신축입주청소','stype_2'=>'거주청소','stype_4'=>'이사청소'];
    return ( !isset ( $type['stype_'.$this->stype] ) ) ? '건물형태없음' : $type['stype_'.$this->stype];
  }
  public function getUserNameAttribute() {
    if( $this->del_userinfo != 'N') return '정보삭제';
    else return $this->register_name;
  }
  public function getUserPhoneAttribute() {
    if( $this->del_userinfo != 'N') return '정보삭제';
    else return $this->register_phone;
  }
  public function getFormatedPhoneAttribute(){
    if( $this->del_userinfo != 'N') return '정보삭제';
    try{
      $tel = preg_replace('/[^0-9]/', '', $this->register_phone);
      return preg_replace('/(^02.{0}|^01.{1}|^15.{2}|^16.{2}|^18.{2}|[0-9]{3})([0-9]+)([0-9]{4})/', '$1-$2-$3', $tel);
    }catch (\Exception $e){
      return $this->register_phone;
    }
  }
}
?>
