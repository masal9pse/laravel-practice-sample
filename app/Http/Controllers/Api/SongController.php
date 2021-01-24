<?php

namespace App\Http\Controllers\Api;

use App\Models\Song;
use App\Http\Controllers\Controller; // 大事！！
use Illuminate\Support\Facades\Auth;

class SongController extends Controller
{
 public function destroy($id)
 {
  $song = Song::find($id);
  $song->delete();
  return $song;
 }
}
