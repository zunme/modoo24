<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuctionOrderNfaceTest extends Model
{
	public $timestamps = false;
	protected $table = 'auction_order_nface_test';
	protected $primaryKey = 'uid';

	protected $fillable = ['order_path', 's_uid', 's_with2', 'sido', 'gugun', 'mdate', 'name', 'passwd', 'hp', 'classify', 'stype',
    's_zip1', 's_addr1', 's_addr2', 's_area', 's_floor', 's_el', 's_park',
    'e_zip1', 'e_addr1', 'e_area', 'e_floor', 'e_el', 'e_park',
    'goods', 'note', 'img_files', 'keep', 'type', 'clean_yn',
    's_check_type', 'share_status', 'reg_company_type', 'cafe_name',
		'user_memo','selck'
	];
  protected $casts = [
		'goods' => 'array',
    'img_files' => 'array',
	];
}
