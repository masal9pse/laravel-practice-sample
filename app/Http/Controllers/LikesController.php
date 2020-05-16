<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Illuminate\Support\Facades\Auth;
use App\Models\Song;

class LikesController extends Controller
{

 public function store(Request $request, $songId)
 {
  Like::create(
   array(
    'user_id' => Auth::user()->id,
    'song_id' => $songId
   )
  );

  $song = Song::findOrFail($songId);

  return redirect()
   ->action('SongController@show', $song->id);
 }

 public function destroy($songId, $likeId)
 {
  $song = Song::findOrFail($songId);
  $song->like_by()->findOrFail($likeId)->delete();

  return redirect()
   ->action('SongController@show', $song->id);
 }
}
