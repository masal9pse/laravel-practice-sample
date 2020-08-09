<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reply;

class Comment extends Model
{
 protected $fillable = [
  'user_id', 'song_id', 'comment'
 ];

 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }

 public function replies()
 {
  return $this->hasMany(Reply::class, 'comment_id', 'id');
 }
}
