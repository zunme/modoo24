<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionOrderInfoEnc extends Model
{
	protected $table = 'auction_order_info_enc';
	protected $primaryKey = 'id';

	protected $fillable = ['admin_id','admin_name','order_id','order_type','name','phone'];
}
