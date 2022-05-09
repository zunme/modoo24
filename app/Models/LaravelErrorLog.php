<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LaravelErrorLog extends Model
{
	protected $table = 'laravel_error_logs';
	protected $primaryKey = 'id';
  protected $fillable = ['type','parent_id','data','msg'];
  protected $casts = [
    'data' => 'object'
  ];
}
