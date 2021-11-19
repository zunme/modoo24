<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewFile extends Model
{
	protected $table = 'review_files';
	protected $fillable = ['review_id','url'];
  public $timestamps = false;
}
