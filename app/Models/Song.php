<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Like;
use App\Models\User;
use App\Comment;

class Song extends Model
{
 protected $fillable = [
  'title', 'detail', 'likes_count', 'file_name', 'search'
 ];

 // protected $with = ['tags'];

 public function admin()
 {
  return $this->belongsTo(Admin::class);
 }
 // 追加
 public function likes()
 {
  return $this->hasMany('App\Like');
 }


 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }

 public function comments()
 {
  return $this->hasMany(Comment::class, 'song_id', 'id');
 }

 public function like_by()
 {
  return Like::where('user_id', \Auth::user()->id)->first();
 }

 public function tags()
 {
  return $this->belongsToMany(Tag::class);
 }
}
