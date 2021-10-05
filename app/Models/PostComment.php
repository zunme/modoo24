<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
	protected $table = 'post_comments';
	protected $fillable = ['post_id','auction_staff_s_uid','auction_staff_s_name','is_confirmed','title','body','best_cnt','fav_cnt'];
	
    public function scopeActive($query){
        return $query->where('is_confirmed', 'Y');
    }
}
