<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviewlog extends Model
{
	protected $table = 'review_logs';
	protected $fillable = ['order_type','review_type','order_id','staff_id','review_id'];
}
