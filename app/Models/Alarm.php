<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlarmMember;
class Alarm extends Model
{
	protected $table = 'auction_alram';
	protected $primaryKey = 'aa_idx';
  protected $fillable = ['aa_reg_idx','aa_order_idx','aa_alram_date','aa_memo'];
	public $timestamps = false;
  protected $dates = [
    'aa_alram_date',
	];
	public function members() {
				return $this->hasMany(AlarmMember::class,'aam_aa_idx' );
	}
}
