<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlarmMember;
class Alarm extends Model
{
	protected $table = 'laravel_admn_pusher';
	protected $primaryKey = 'id';
  protected $fillable = ['admin_id','device','token','is_use'];
}
