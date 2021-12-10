<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionOrderNface extends Model
{
	public $timestamps = false;
	protected $table = 'auction_order_nface';
	protected $primaryKey = 'uid';
	protected $fillable = ['name','passwd','hp'];
}
