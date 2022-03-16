<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LaravelTraceLog extends Model
{
	protected $table = 'laravel_trace_logs';
	protected $primaryKey = 'id';
  protected $fillable = ['uniqueId','openId','isMobile','page','step','tranceval','ip','referer','referer_domain'];
}
