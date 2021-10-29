<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostFavorite extends Model
{
	protected $table = 'post_favorites';
  protected $primaryKey = ['post_id', 'user_id'];
  public $incrementing = false;
	protected $fillable = ['post_id','user_id'];

}
