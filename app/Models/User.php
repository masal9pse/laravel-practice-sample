<?php

namespace App\Models;

use App\Like;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Song;

class User extends Authenticatable
{
 use Notifiable;

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [
  'name', 'email', 'password'
 ];

 /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
 protected $hidden = [
  'remember_token',
 ];

 public function songs()
 {
  return $this->belongsToMany(Song::class, 'likes', 'user_id', 'song_id')->withTimestamps();
 }
}
