<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionShareOption extends Model
{
	public $timestamps = false;
	protected $table = 'auction_share_option';
	protected $primaryKey = 'aso_idx';

	protected $fillable = ['aso_reg_idx','aso_order_idx','aso_status','aso_order_kind','aso_visit_date'];

}
