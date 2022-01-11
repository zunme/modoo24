<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MoveGoods extends Model
{
	protected $table = 'move_goods';
	protected $primaryKey = 'id';
	public $timestamps = false;
  protected $fillable = ['type_id','title','options','is_use','goods_sort'];
	protected $casts = [
		'options' => 'array'
	];
}
