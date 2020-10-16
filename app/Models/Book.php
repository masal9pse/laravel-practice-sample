<?php

namespace App\Models;

use App\Comment;
use App\Models\Song;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
 protected $fillable = [
  'song_id', 'title', 'author', 'description', 'thumbnail'
 ];

 //public function user()
 //{
 // return $this->belongsTo(User::class);
 //}
 //public function song()
 //{
 // return $this->belongsTo(Song::class, 'song_id', 'id');
 //}
 //public function comment()
 //{
 // return $this->belongsTo(Comment::class);
 //}
}
