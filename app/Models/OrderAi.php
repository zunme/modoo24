<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OrderAi extends Model
{
  protected $table = 'order_ai';
  protected $fillable = ['movingtype_ai','movingmethod_ai','pyeong_ai','images'];
  protected $casts = [
    'images' => 'object'
  ];
}
