<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
	protected $table = 'post_files';
	protected $fillable = ['post_id','original_name','url','attach_type','attach_size'];

}
