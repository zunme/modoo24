<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionOrder extends Model
{
	public $timestamps = false;
	protected $table = 'auction_order';
	protected $primaryKey = 'uid';

	protected $fillable = ['name','passwd','hp','mdate','order_path','stype','classify','cstype','cafe_name','reg_company_type'
		, 's_with2','s_with3','s_with4'
		,'goods','note','memo'
		,'kaku','junja','jubang','kita','kaku_s','junja_s','jubang_s','kita_s'
		,'aircon_yn'
		,'aircon_wall_cnt','aircon_stand_cnt','aircon_system_cnt','aircon_double_cnt'
		,'type','user_memo'
		,'area','share_status','auto_share','clean_yn','bds_id','keep'
    ,'s_uid','contact_name'
    ,'s_zip1','s_zip2','s_addr1','s_addr2'
    ,'e_zip1','e_zip2','e_addr1','e_addr2'
    ,'s_uid1','s_id1','s_company1','s_give_date1'
    ,'s_uid2','s_id2','s_company2','s_give_date2'
    ,'s_uid3','s_id3','s_company3','s_give_date3'
    ,'com_num','reg_date',
		];
}
