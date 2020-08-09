<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reply;
use App\Models\Song;

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

 public function song()
 {
  return $this->belongsTo(Song::class, 'song_id', 'id');
 }
}
