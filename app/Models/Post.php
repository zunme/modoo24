<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use App\User;
use App\Models\PostComment;
use App\Models\PostCommentDepth;

use App\Models\PostFile;
use App\Events\PostEvent;
use App\Models\BulletinSido;

class Post extends Model
{
	use SoftDeletes;
	use Notifiable;
	protected $table = 'posts';
	protected $fillable = ['bulletin_id','user_id','nickname','noti','is_confirmed','title','body','repImg','fav_cnt','comment_cnt','view_cnt','si_code','gu_code'];

  public function scopeActive($query){
        return $query->where('is_confirmed', 'Y');
  }
	public function users() {
        return $this->hasOne(User::class,'id', 'user_id' )->select('id','email','nickname')->withTrashed();
  }
	public function comments() {
    return $this->hasMany(PostComment::class,'post_id' )->where('post_comments.is_confirmed', '=', 'Y')->orWhere('post_comments.is_confirmed', '=', 'R')
		->join('auction_staff', 'post_comments.auction_staff_s_uid','=','auction_staff.s_uid')
		;
  }
	public function simplecomments() {
		return $this->hasMany(PostComment::class,'post_id' )->select('post_comments.*', 'auction_staff_s_uid','s_company','s_mobile_img0')->where('post_comments.is_confirmed', '=', 'Y')->orWhere('post_comments.is_confirmed', '=', 'R')
		->join('auction_staff', 'post_comments.auction_staff_s_uid','=','auction_staff.s_uid')
		;
	}
	public function files() {
        return $this->hasMany(PostFile::class,'post_id' );
  }
	public function needconfirm(){
		return $this->hasMany(PostComment::class,'post_id' )->where('post_comments.is_confirmed', '=', 'R');
	}
	public function needconfirmdepth(){
		return $this->hasMany(PostCommentDepth::class,'post_id' )->where('post_comment_depth.is_confirmed', '=', 'R');
	}
	public function address() {
				return $this->hasOne(BulletinSido::class,'gu_code', 'gu_code' )->where(['depth'=>2]);
	}
	protected $events = [
			 'created' => PostEvent::class,
	 ];
}
