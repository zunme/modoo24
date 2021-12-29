<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
  protected $table = 'laravel_site_configs';
  protected $fillable = ['code','code_value','code_desc'];
  protected $casts = [
    'code_value' => 'array'
  ];
}
