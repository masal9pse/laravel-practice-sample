<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Like;
use App\Models\User;
use App\Comment;
use App\Models\Tag;

class Song extends Model
{
 protected $table = 'songs';
 // create文などのeloquentを使用するには$fillableや$guardで指定しないとダメ
 protected $fillable = [
  'title', 'detail', 'file_name', 'like_count'
 ];

 protected $with = ['tags'];

 public function admin()
 {
  return $this->belongsTo(Admin::class);
 }
 public function books()
 {
  return $this->hasMany(Book::class);
 }
 //public function likes(): BelongsToMany
 //{
 // return $this->BelongsToMany(User::class, 'likes');
 //}

 public function likes()
 {
  return $this->hasMany(Like::class, 'song_id');
 }

 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }

 public function users()
 {
  //return $this->belongsToMany(User::class)->withTimestamps();
  return $this->belongsToMany(User::class)->using(Like::class)->withTimestamps();
 }

 public function comments()
 {
  //return $this->hasMany(Comment::class, 'song_id', 'id');
  return $this->hasMany(Comment::class);
 }

 public function replies()
 {
  return $this->hasMany(Reply::class);
 }

 public function like_by()
 {
  return Like::where('user_id', \Auth::user()->id)->first();
 }

 // belongsToManyを使うとsong_tagモデルを作らなくても、自動的に中間テーブルに紐付けできる
 public function tags()
 {
  return $this->belongsToMany(Tag::class);
 }

 public function titleSearch($search, $songs)
 {
  if ($search && $songs != null) {
   $songs->where('title', 'like', '%' . $search . '%')->get();
  }
 }
}
