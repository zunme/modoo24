<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

use App\Models\PostCommentLog;

class AuctionPopup extends Model
{
	protected $table = 'auction_popup';
	protected $primaryKey = 'bp_idx';

  protected $casts = [
		'bp_file' => 'object',
  ];
}
