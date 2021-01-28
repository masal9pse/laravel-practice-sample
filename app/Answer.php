<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;

class Answer extends Model
{
 public function favorites()
 {
  $this->hasMany(Favorite::class);
 }
}
