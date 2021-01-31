<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Problem;
use Illuminate\Support\Facades\DB;

class SongController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index(Request $request)
 {
  $search = $request->input('search');
  $songs = Song::with(['tags', 'comments', 'likes'])->orderBy('id', 'asc')->paginate(3);

  //dd($songs);
  if ($search) {
   // sqlのselect文とほぼ同じ、idが競合しているためエイリアスをつくる => whereHasならデータを参照するだけで紐付けしていないのでidの競合を避けることができる。
   //DB::enableQueryLog();
   $songs = Song::with(['tags', 'comments', 'likes'])
    ->where('title', 'like', '%' . $search . '%')->orWhere('detail', 'like', '%' . $search . '%')
    ->orWhereHas('comments', function ($query) use ($search) {
     $query->where('comment', 'like', '%' . $search . '%');
    })->orWhereHas('tags', function ($query) use ($search) {
     $query->where('title', 'like', '%' . $search . '%');
    })
    ->paginate(3);
   //dd(DB::getQueryLog());
  }

  return view('songs.index', [
   'songs' => $songs,
  ]);
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Song  $song
  * @return \Illuminate\Http\Response
  */
 public function show(Request $request)
 {
  $song = Song::with('user', 'comments', 'likes', 'comments.replies.user')->find($request->id);
  list($userAuth, $getLike, $isLike) = $this->likeFunc($song);

  $params = [
   'userAuth' => $userAuth,
   'song' => $song,
   'getLike' => $getLike,
   'isLike' => $isLike
  ];

  return view('songs.show', $params);
 }

 private function likeFunc($song)
 {
  $userAuth = \Auth::user();
  $getLike = count($song->likes);
  //$isLike = $song->likes()->where('user_id', $userAuth->id)->first();
  $isLike = $song->likes->where('user_id', $userAuth->id)->first();
  if (count($isLike) == 0) {
   $isLike == false;
  } else {
   $isLike == true;
  }
  return [$userAuth, $getLike, $isLike];
 }
}
