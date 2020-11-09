<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Song;
use App\Models\Tag;

class SongTag extends Model
{
 protected $table = 'song_tag';

 protected $fillable = ['song_id', 'tag_id'];

 public function Song()
 {
  return $this->belongsTo(Song::class);
 }

 public function Tag()
 {
  return $this->belongsTo(Tag::class);
 }
}
