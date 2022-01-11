<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\MoveGoods;
class MoveGoodsType extends Model
{
	protected $table = 'move_goods_types';
	protected $primaryKey = 'id';
	public $timestamps = false;
	public function items() {
				return $this->hasMany(MoveGoods::class,'type_id' )->orderBy('goods_sort','asc')->orderBy('id','asc');
	}
}
