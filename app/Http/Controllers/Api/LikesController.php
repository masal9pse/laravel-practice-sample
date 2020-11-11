<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Like;
use App\Models\Song;
use App\Http\Controllers\Controller; // 大事！！
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
 public function like(Song $song, Request $request)
 {
  $like = Like::create(['song_id' => $song->id, 'user_id' => $request->user_id]);

  $likeCount = count(Like::where('song_id', $song->id)->get());

  return response()->json(['likeCount' => $likeCount]);
 }

 public function unlike(Song $song, Request $request)
 {
  $like = Like::where('user_id', $request->user_id)->where('song_id', $song->id)->first();
  $like->delete();

  $likeCount = count(Like::where('song_id', $song->id)->get());

  return response()->json(['likeCount' => $likeCount]);
 }

 public function index()
 {
  $like = Like::all();
  return $like;
 }

 public function show(Song $song)
 {

  $likeShows = Song::find($song->id)->likes;
  foreach ($likeShows as $like) {
   $like_id = $like->song_id;
  }
  return $like_id;
 }
}
