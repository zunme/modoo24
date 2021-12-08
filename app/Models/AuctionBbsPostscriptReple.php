<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionBbsPostscriptReple extends Model
{
	protected $table = 'auction_bbs_postscript_reple';
	protected $primaryKey = 'r_idx';
  protected $fillable = ['r_uid','r_name','r_content','r_ip','r_admin_flag'];
	public $timestamps = false;
  protected $dates = [
    'r_reg_date',
	];
}
