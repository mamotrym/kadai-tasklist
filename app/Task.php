<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'status', 'content',
    ];
    
    /**
     * この投稿を所有するユーザ
     */
     public function user()
     {
         return $this->belongsTo(User::class);
     }
}
