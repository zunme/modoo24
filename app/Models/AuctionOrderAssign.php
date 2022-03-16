<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionOrderAssign extends Model
{
	public $timestamps = false;
	protected $table = 'auction_order_assign';
	protected $primaryKey = 'o_a_uid';
	protected $fillable = [
		'assign_sort','o_uid','s_uid','s_id','s_company','s_give_date','s_reg_type','reg_date'
	];
}
