<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCommentLog extends Model
{
	protected $table = 'post_comment_logs';
	protected $primaryKey = 'auction_staff_s_uid';
	protected $fillable = ['auction_staff_s_uid','comment_cnt','fav_cnt','best_cnt'];
	
	public function scopeFindOrCreate($query, $id)
	{
			$obj = $query->find($id);
			return $obj ?: new static;
	}
}