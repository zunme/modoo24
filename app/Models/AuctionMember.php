<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionMember extends Model
{
	protected $table = 'auction_member';
	protected $primaryKey = 'am_idx';
	public $timestamps = false;
}
