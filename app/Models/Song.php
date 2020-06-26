<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Admin;
use App\Like;
use App\Models\User;
use App\Comment;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
 protected $table = 'songs';

 protected $fillable = [
  'title', 'detail', 'likes_count', 'file_name',
 ];

 protected $with = ['tags'];

 public function admin()
 {
  return $this->belongsTo(Admin::class);
 }
 // 追加
 public function likes(): BelongsToMany
 {
  return $this->BelongsToMany(User::class, 'likes');
 }

 public function isLikedBy(?User $user): bool
 {
  return $user
   ? (bool) $this->likes->where('id', $user->id)->count()
   : false;
 }

 public function getCountLikesAttribute(): int
 {
  return $this->likes->count();
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

 // これはだめ
 public function titleSearch($search)
 {
  return where('title', 'like', '%' . $search . '%');
 }
 // error 
 public function isLike(Int $user_id)
 {
  return $this->where('user_id', $user_id)->first();
 }

 public function paginateText()
 {
  return  orderBy('id', 'desc')->paginate(10);
 }
}
