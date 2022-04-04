<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class LaravelAlimtokLog extends Model
{
  protected $table = 'laravel_alimtok_logs';
  protected $fillable = ['uid','order_type','template','hp','name','offer_cnt','mdate','send_status','desc'];
}
