<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AlarmMember extends Model
{
	protected $table = 'auction_alram_member';
	protected $primaryKey = 'aam_idx';
  protected $fillable = ['aam_aa_idx','aam_mem_idx','aam_flag'];
	public $timestamps = false;
}
