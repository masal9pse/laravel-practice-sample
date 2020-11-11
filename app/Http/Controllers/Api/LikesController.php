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
 //public function show($id)
 {
  //dd($likeInstance);
  $userAuth = \Auth::user();
  $song = Song::find($song->id);
  //$song = Song::find($song->id)->likes;

  //dd($song);
  //$like = Like::where('user_id', \Auth::id())->where('song_id', $song->id)->first();
  //$like = $song->likes()->where('user_id', $userAuth->id)->first();
  // カウントする際に使う
  //$like = Like::where('song_id', $song->id)->get();
  //$like = new Like();
  //$like = Like::where('song_id', $like->song_id)->get(); // これだととれない
  //$like->load('Song');
  //return [$song, $like];
  return $song;
 }
}
