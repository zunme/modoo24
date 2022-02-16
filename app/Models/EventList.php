<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EventList extends Model
{
  protected $table = 'events_list';
  protected $fillable = ['title','writer','prc_ing','prc_ing_sub','view_cnt','duration','mobile_img','pc_img','list_img'
    ,'use_main','is_use','external_link','desc','loadexternal'];

}
