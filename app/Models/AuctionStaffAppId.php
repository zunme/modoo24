<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class AuctionStaffAppId extends Model
{
	public $timestamps = false;
	protected $table = 'auction_staff_app_push_ids';
	protected $primaryKey = 's_uid';
	protected $fillable = ['s_uid','s_id','app_push_id','reg_date'];
}
