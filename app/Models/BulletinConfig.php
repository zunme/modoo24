<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BulletinConfig extends Model
{
	protected $table = 'bulletin_configs';
	protected $fillable = ['title', 'is_use', 'html_use', 'use_confirm','comment_use','use_comment_confirm'];
	
    public function scopeActive($query){
        return $query->where('is_use', 'Y');
    }
    public function activate(){
       return $this->update(['is_use' => 'Y']);
   }
   public function deactivate(){
        return $this->update(['is_use' => 'N']);
    }	
}
