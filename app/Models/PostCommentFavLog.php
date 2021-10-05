<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCommentFavLog extends Model
{
	protected $table = 'post_comment_fav_logs';
	protected $fillable = ['comment_id','auction_staff_s_uid'];
}
