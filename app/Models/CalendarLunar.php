<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;
use App\Models\PostComment;
use App\Models\PostFile;

class CalendarLunar extends Model
{

	protected $table = 'calendar_lunar_solar';
	protected $appends = ['start','overlap', 'display', 'backgroundColor'];

	public function getStartAttribute(){
		return $this->solar_date;
		//return false;
	}
	public function getOverlapAttribute(){
		return false;
	}
	public function getDisplayAttribute(){
		return 'background';
	}
	public function getBackgroundcolorAttribute(){
		return '#00b9ba';
	}
}
