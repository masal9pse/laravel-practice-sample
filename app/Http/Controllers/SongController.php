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
  //$songs = DB::table('songs')
  // ->select('songs.id as song_alias_id', 'title')
  // ->orderBy('song_alias_id', 'desc')->paginate(3);
  $songs = Song::orderBy('id', 'asc')->paginate(3);
  if ($search) {
   // sqlのselect文とほぼ同じ、idが競合しているためエイリアスをつくる => whereHasならデータを参照するだけで紐付けしていないのでidの競合を避けることができる。
   $songs = Song::where('title', 'like', '%' . $search . '%')->orWhere('detail', 'like', '%' . $search . '%')
    ->orWhereHas('comments', function ($query) use ($search) {
     $query->where('comment', 'like', '%' . $search . '%');
     //})->paginate(3);
    })->toSql();
   dd($songs);
   //foreach ($songs as $song) {
   // dd($song->comments()->comment);
   //}
   //exit;
   //dd($songs);
   //$songs = DB::table('songs')
   // ->select('songs.id as song_alias_id', 'comments.id as comment_id', 'title')
   // ->leftJoin('comments', 'songs.id', '=', 'comments.song_id')->where('songs.title', 'like', '%' . $search . '%')
   // ->orWhere('songs.detail', 'like', '%' . $search . '%')->orWhere('comments.comment', 'like', '%' . $search . '%')->orderBy('songs.id', 'desc')->paginate(3);
  }
  $problems = Problem::all();

  return view('songs.index', [
   'songs' => $songs,
   'problems' => $problems,
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
  //dd($request->id);
  //$test = $request->id;
  //dd($request);
  //$song = Song::find($request->id);
  $song = Song::with('user', 'comments', 'likes', 'comments.replies.user')->find($request->id);
  //$song = Song::with('user', 'comments', 'likes', 'comments.replies.user')->where('id', $id)->first();
  //dd($song);
  //$song->load('user', 'books', 'comments', 'likes', 'comments.replies.user');
  //dd($song);
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
