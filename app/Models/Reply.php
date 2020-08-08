<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
 protected $fillable = [
  'user_id', 'comment_id', 'reply'
 ];

 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }
}
