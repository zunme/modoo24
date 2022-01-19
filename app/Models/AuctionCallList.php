<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionCallList extends Model
{
	public $timestamps = false;
	protected $table = 'auction_call_list';
	protected $primaryKey = 'b_no';

	protected $fillable = ['uid','s_uid','point','send_number','get_number','b_typ','reg_date','b_rp'];
}
