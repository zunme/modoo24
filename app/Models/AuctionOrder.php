<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionOrder extends Model
{
	public $timestamps = false;
	protected $table = 'auction_order';
	protected $primaryKey = 'uid';

	protected $fillable = ['name','passwd','hp'];
}
