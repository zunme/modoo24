<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionSmsConfirm extends Model
{
	public $timestamps = false;
	protected $table = 'auction_sms_confirm_num';
	protected $primaryKey = 'ascn_idx';
	protected $fillable = ['ascn_auth_no','ascn_hp'];

}
