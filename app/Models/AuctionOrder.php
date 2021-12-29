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
		,'area','share_status','auto_share','clean_yn','bds_id'
		];
}
