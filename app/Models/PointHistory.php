<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PointHistory extends Model
{
	public $timestamps = false;
	protected $table = 'point_history';
	protected $primaryKey = 'idx';

	protected $fillable = ['reg_date','o_uid','s_uid','m_uid','content'
    ,'point','old_point','new_point','old_service_point','new_service_point'
		, 'type'
	];

}
