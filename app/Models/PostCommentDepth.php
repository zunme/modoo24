<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCommentDepth extends Model
{
  use SoftDeletes;
	protected $table = 'post_comment_depth';
	protected $fillable = ['user_id','post_id','group_id','parent_id','depth_no','order_no','right_max','comment','nickname','is_confirmed'];

  protected $dates = [
      'created_at', 'updated_at'
  ];

}
