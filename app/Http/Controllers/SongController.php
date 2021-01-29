<?php

namespace App\Http\Controllers;

use App\Like;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Problem;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use stdClass;

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
  $songs = DB::table('songs')
   ->select('songs.id as song_alias_id', 'title')
   ->orderBy('song_alias_id', 'desc')->paginate(3);
  //dd($songs);
  //$songs = Song::orderBy('id', 'desc')->paginate(3);
  //foreach ($songs as $a) {
  // dd($a);
  //}
  if ($search) {
   // クエリビルダ 検索状態で
   // sqlのselect文とほぼ同じ、idが競合しているためエイリアスをつくる
   $songs = DB::table('songs')
    ->select('songs.id as song_alias_id', 'comments.id as comment_id', 'title')
    ->leftJoin('comments', 'songs.id', '=', 'comments.song_id')->where('songs.title', 'like', '%' . $search . '%')
    ->orWhere('songs.detail', 'like', '%' . $search . '%')->orWhere('comments.comment', 'like', '%' . $search . '%')->orderBy('songs.id', 'desc')->paginate(3);
   //dd($songs);
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
