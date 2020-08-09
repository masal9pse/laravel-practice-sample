<?php

namespace App\Models;

use App\Comment;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reply extends Model
{
 protected $fillable = [
  'comment_id', 'reply'
 ];

 // public function user()
 // {
 //  return $this->belongsTo(User::class);
 // }

 public function comment()
 {
  return $this->belongsTo(Comment::class);
 }
}
