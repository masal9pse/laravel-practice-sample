<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
 protected $fillable = [
  'user_id', 'song_id', 'comment'
 ];

 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }
}
