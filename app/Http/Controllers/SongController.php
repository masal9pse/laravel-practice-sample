<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Problem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateSongTask;

class SongController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index(Request $request)
 {
  $create_song_task = new CreateSongTask;
  //dd($create_song_task->test());
  $search = $request->input('search');
  $songs = Song::with(['tags', 'comments', 'likes'])->orderBy('id', 'asc')->paginate(3);

  //dd($songs);
  if ($search) {
   // sqlのselect文とほぼ同じ、idが競合しているためエイリアスをつくる => whereHasならデータを参照するだけで紐付けしていないのでidの競合を避けることができる。
   //DB::enableQueryLog();
   // select => explain
   $songs = Song::with(['tags', 'comments', 'likes'])
    ->where('title', 'like', '%' . $search . '%')->orWhere('detail', 'like', '%' . $search . '%')
    ->orWhereHas('comments', function ($query) use ($search) {
     $query->where('comment', 'like', '%' . $search . '%');
    })->orWhereHas('tags', function ($query) use ($search) {
     $query->where('title', 'like', '%' . $search . '%');
    })
    ->paginate(3);
   //dd(DB::getQueryLog());
   //dd($songs);
  }

  return view('songs.index', [
   'songs' => $songs,
  ]);
 }

 public function like(Request $request)
 {
  //dd($song->users());
  // エラー文⬇️
  //insert into "likes" ("created_at", "song_id", "updated_at", "user_id") values (2021-02-01 02:35:21, , 2021-02-01 02:35:21, 4)
  // ただnewしただけのインスタンスだと上記のようなSQLになりsong_idに値が入っていなかったので、findでsong_idに値をぶち込む
  $song = Song::find($request->id);
  $song->users()->attach(Auth::id());

  return back();
 }

 public function unlike(Request $request)
 {
  $song = Song::find($request->id);
  $song->users()->detach(Auth::id());

  return back();
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
