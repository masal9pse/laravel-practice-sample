<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Like;

class LikeController extends Controller
{
 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 //public function store(Song $song)
 //public function store($id)
 public function store(Request $request)
 {
  //$song_id = $request->query(); // これだとなぜか取れない
  $song_id = $request->id; // これだと取得できた。
  //dd($song_id);
  Like::create([
   'song_id' => $song_id,
   'user_id' => Auth::id(),
  ]);
  //session()->flash('success', 'You Liked the Reply.');
  return redirect()->back();
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy(Request $request)
 {
  //$like = Like::where('song_id', $request->id)->where('user_id', Auth::id())->first();
  //$like->delete();
  Like::where('song_id', $request->id)->where('user_id', Auth::id())->delete();
  //dd($like);

  //session()->flash('success', 'You Unliked the Reply.');

  return redirect()->back();
 }
}
