<?php

namespace App\Services;

use App\Models\Song;

class SongService
{
 public function getSong()
 {
  return Song::all();
 }

 public function higedan()
 {
  return 'pretender';
 }
}
