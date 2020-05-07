<?php

namespace App\Models;

use App\Admin;
use Illuminate\Database\Eloquent\Model;
use App\Models\Song;

class Tag extends Model
{
 protected $fillable = [
  'id', 'title'
 ];

 public function songs()
 {
  return $this->belongsToMany(Song::class);
 }
}
