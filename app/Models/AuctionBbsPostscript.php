<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReviewFile;
use App\Models\AuctionBbsPostscriptReple;
class AuctionBbsPostscript extends Model
{
	protected $table = 'auction_bbs_postscript';
	protected $primaryKey = 'b_uid';
  protected $fillable = ['b_name','b_note'
		,'b_ip','b_type','b_worker_idx','b_mdate'
		,'b_star_pro','b_star_kind','b_star_price','b_star_finish','b_star_expost','b_star_pave'
		,'b_hp','b_re_use','b_admin_flag','b_atype'
	];
	public $timestamps = false;
	public function files() {
				return $this->hasMany(ReviewFile::class,'review_id' );
	}
	public function repl() {
				return $this->hasOne(AuctionBbsPostscriptReple::class,'r_uid' );
	}
}
