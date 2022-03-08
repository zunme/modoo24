<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\PostCommentLog;

class AuctionStaff extends Model
{
	public $timestamps = false;
	protected $table = 'auction_staff';
	protected $primaryKey = 's_uid';
	protected $fillable = ['s_id','s_passwd','s_nickname','s_company'
		,'s_ceo_name','s_ceo_hp','s_ceo_hp_plus','s_tel','s_vn','s_homepage','s_email','s_zip','s_addr1','s_addr2'
		,'s_career','s_staff_num','s_bank_title','s_bank_ac_name','s_bank_ac_number','s_payment'
		,'s_license1','s_license2','s_contact_name','s_contact_hp','s_city','s_destination','s_destination_flag'
		,'s_level','s_classify1','s_classify2','s_classify3','s_classify4','s_classify5','s_classify6','s_classify7'
		,'s_gubun','s_memo','s_indate','s_outdate','s_onout','s_ip','s_join_date','s_reg_date','s_sadari','s_1t','s_2_5t','s_5t','s_r_05t','s_d_05t'
		,'s_name','last_order_date','auto_match','point','service_point','type','s_share_flag','s_share_cnt','s_share_day_cnt'
		,'flat_rate_date','flat_rate_staff','flat_rate_cnt','flat_staff_close_day','s_ton_1','s_ton_2_5','s_ton_5','s_ton_6','s_ton_7_5','s_ton_10','s_ton_20'
		,'cmt1','cmt2','cmt3','s_mobile_img0','s_mobile_img1','s_mobile_img3_1','s_mobile_img3_2','s_mobile_img3_3','s_mobile_img3_4'
		,'s_mobile_memo','app_push_id'
		];
	protected $hidden = ['s_passwd'];
	protected $appends = ['sclassify','flat_rate_staff_name','s_city_arr', 's_level_name','s_gubun_name','equipments_arr','note_arr','s_mobile_img3_arr','s_staff_number','s_pay_arr', ];
	protected $casts = [
		's_mobile_img0' => 'object',
		's_mobile_img1' => 'object',
		's_mobile_img2' => 'object',
		's_mobile_img3_1' => 'object',
		's_mobile_img3_2' => 'object',
		's_mobile_img3_3' => 'object',
		's_mobile_img3_4' => 'object',
	];
	public function commentlogs() {
        return $this->hasOne(PostCommentLog::class,'auction_staff_s_uid', 's_uid' );
  }
	/* append */
	public function getSMobileImg3ArrAttribute(){
		$cols = [];
		if ($this->s_mobile_img3_1 != null) $cols[] = $this->s_mobile_img3_1;
		if ($this->s_mobile_img3_2 != null) $cols[] = $this->s_mobile_img3_2;
		if ($this->s_mobile_img3_3 != null) $cols[] = $this->s_mobile_img3_3;
		if ($this->s_mobile_img3_4 != null) $cols[] = $this->s_mobile_img3_4;
		return $cols;
	}
	public function getSCityArrAttribute(){
		$ret = explode('|', $this->s_city);
		if ($ret[count($ret)-1] =='')  array_pop($ret);
		return $ret ;
	}

	public function getSPayArrAttribute(){
		$ret = explode('|', $this->s_payment);
		
		$replace_search = array("C", "P", "A", "R", "T");
		$replace_target = array("카드", "현금결제", "계좌이체", "현금영수증", "세금계산서");
		$ret = str_replace($replace_search, $replace_target, $ret);

		if ($ret[count($ret)-1] =='')  array_pop($ret);

		return $ret ;
	}

	public function getSclassifyAttribute() {
		$cols = [];
		if( $this->s_classify1 == 1 ) $cols[] = '가정';
		if( $this->s_classify2 == 1 ) $cols[] = '사무실';
		if( $this->s_classify3 == 1 ) $cols[] = '소형/원룸';
		if( $this->s_classify4 == 1 ) $cols[] = '비대면소형';
		if( $this->s_classify5 == 1 ) $cols[] = '비대면가정';
		if( $this->s_classify6 == 1 ) $cols[] = '비대면사무실';
		if( $this->s_classify7 == 1 ) $cols[] = '비대면차량';
		//return implode(',',$cols);
		return $cols;
	}
	public function getFlatRateStaffNameAttribute(){
		return $this->flat_rate_staff =='Y' ? '정액제':'일반';
	}
	
	public function getSLevelNameAttribute(){
		switch( $this->s_level ) {
			case('2'):
				return '지점업체';
			case('3'):
				return '협력업체';
			default :
				return '구분없음';
		}
	}
	public function getSGubunNameAttribute(){
		switch( $this->s_level ) {
			case('1'):
				return '서울권';				
			case('2'):
				return '수도권';
			case('3'):
				return '지방권';
			default :
				return '';
		}
	}

	public function getSStaffNumberAttribute(){
		$cols = [];
		if( $this->s_staff_num == 1 ) $cols[] = '1~10';
		if( $this->s_staff_num == 2 ) $cols[] = '11~20';
		if( $this->s_staff_num == 3 ) $cols[] = '21~40';
		if( $this->s_staff_num == 4 ) $cols[] = '40 이상';
		//return implode(',',$cols);
		return $cols;
	}
	public function getEquipmentsArrAttribute(){
		$cols = [];
		$cols[] = ["name"=>'사다리', 'cnt'=>$this->s_sadari];
		$cols[] = ["name"=>'1톤', 'cnt'=>$this->s_1t];
		$cols[] = ["name"=>'2.5톤', 'cnt'=>$this->s_2_5t];
		$cols[] = ["name"=>'5톤', 'cnt'=>$this->s_5t];
		$cols[] = ["name"=>'0.5톤 라보', 'cnt'=>$this->s_r_05t];
		$cols[] = ["name"=>'0.5톤 다마스', 'cnt'=>$this->s_d_05t];
		//return implode(',',$cols);
		return $cols;		
	}
	public function getNoteArrAttribute(){
		return  preg_split("/\r\n|\n|\r/", $this->note);
	}
}