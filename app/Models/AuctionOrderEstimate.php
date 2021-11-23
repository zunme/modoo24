<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\PostCommentLog;

class AuctionOrderEstimate extends Model
{
	protected $table = 'auction_order_estimate';
	protected $primaryKey = 'o_e_uid';
	protected $casts = [
		'reg_date'=> 'date'
	];
}
