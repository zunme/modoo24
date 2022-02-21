<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionCleanOrder extends Model
{
	public $timestamps = false;
	protected $table = 'auction_clean_order';
	protected $primaryKey = 'uid';

	protected $fillable = ['m_uid','contact_name','order_path','s_uid','s_with2','s_with3','s_with4','mdate','company'
    ,'name'
		, 'passwd','hp','classify'
		,'stype','s_zip1','s_zip2'
		,'s_addr1','s_addr2','note','memo'
    ,'s_uid1','s_id1','s_company1','s_give_date1'
		,'s_uid2','s_id2','s_company2','s_give_date2'
    ,'s_uid3','s_id3','s_company3','s_give_date3'
		,'com_num','cstype'
		,'cafe_name','reg_date'
    ,'aircon_yn','type','user_memo',
    'area','share_status','share_price','clean_staff_cnt',
    'clean_add_service1','clean_add_service2','clean_add_service3','clean_add_service4',
    'clean_elevator','clean_addr_pyoung','order_uid','modooclean_send',
		];
}
