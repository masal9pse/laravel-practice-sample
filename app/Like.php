<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;
use App\Models\Song;
use App\Models\User;

class Like extends Model
{
 use CounterCache;

 public $counterCacheOptions = [
  'Song' => [
   'field' => 'likes_count',
   'foreignKey' => 'song_id'
  ]
 ];

 protected $fillable = ['user_id', 'song_id'];

 public function Song()
 {
  return $this->belongsTo(Song::class);
 }

 public function User()
 {
  return $this->belongsTo(User::class);
 }
}
