<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
 protected $fillable = [
  'song_id', 'title', 'author', 'description', 'thumbnail'
 ];
}
