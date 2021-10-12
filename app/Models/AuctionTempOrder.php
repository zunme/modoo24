<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuctionTempOrder extends Model
{
	public $timestamps = false;
	protected $table = 'auction_temp_order';
	protected $primaryKey = 't_idx';
	protected $fillable = ['t_type','t_name','t_hp','t_kinds','t_dday','t_memo','t_marketing'];

}
