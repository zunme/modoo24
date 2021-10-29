<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\PostCommentLog;

class AuctionOrderContract extends Model
{
	protected $table = 'auction_order_contract';
	protected $primaryKey = 'o_c_uid';
}
