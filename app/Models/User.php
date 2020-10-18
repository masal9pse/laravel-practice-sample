<?php

namespace App\Models;

use App\Like;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
 use Notifiable;

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [
  'name', 'email', 'password', 'self_introduction', 'sex', 'img_name'
 ];

 /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
 protected $hidden = [
  'password', 'remember_token',
 ];

 public function likes()
 {
  return $this->hasMany(Like::class);
 }
}
