<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AdminPusher extends Model
{
	protected $table = 'laravel_admn_pusher';
	protected $primaryKey = 'id';
  protected $fillable = ['admin_id','device','token','is_use'];
}
