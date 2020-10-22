<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Like;
use App\Models\Song;
use App\Http\Controllers\Controller; // 大事！！

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
}
