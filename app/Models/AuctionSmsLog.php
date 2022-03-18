<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\PostCommentLog;

class AuctionSmsLog extends Model
{
	public $timestamps = false;
	protected $table = 'auction_sms_log';
	protected $primaryKey = 'asl_idx';
	protected $fillable = ['asl_sms','asl_sms_type','asl_subject','asl_contents'
    ,'asl_upfile_json','asl_return_log'];
}
