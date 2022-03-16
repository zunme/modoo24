<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionOrderNum extends Model
{
  public $timestamps = false;
	protected $table = 'auction_order_num';
	protected $primaryKey = 'uid';
	protected $fillable = [
		'order_uid','s_uid1','s_id1','s_company1','s_uid2','s_id2','s_company2','s_uid3','s_id3','s_company3'
    ,'now_date','reg_date'
	];
}
