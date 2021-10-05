<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostCommentBestLog extends Model
{
	protected $table = 'post_comment_best_logs';
	protected $fillable = ['comment_id','user_id'];
}