<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
	protected $table = 'push_notifications';
  protected $primaryKey = 'pn_idx';
  public $timestamps = false;
	protected $fillable = ['pn_reg_date','pn_title','pn_contents','pn_url','pn_img_url',
  'pn_type','pn_staff_idx','pn_push_id',
  ];

}
