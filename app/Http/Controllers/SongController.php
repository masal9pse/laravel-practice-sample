<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Problem;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class SongController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index(Request $request)
 {
  //dd(DB::table('songs')->paginate(10));
  //dd(Song::paginate(10)->count());
  //dd($request->query('search'));
  //dd(Song::class);
  //dd(Song::with('tags')->query()->toSql());
  //dd(collect(['name' => 'taylor', 'framework' => 'laravel']));
  //dd(['name' => 'taylor', 'framework' => 'laravel'] . get());
  $search = $request->input('search');
  //dd($search);
  $songs = Song::orderBy('id', 'desc')->paginate(3);
  //dd(Song::with('tags')->orderBy('id', 'desc')->toSql());
  if ($search) {
   $songs = Song::where('title', 'like', '%' . $search . '%')->orderBy('id', 'desc')->paginate(3);
  }

  //$songs = Song::query()->with('tags');
  ////$sql = DB::table('users')
  //// ->where('status', '<>', 1)
  //// ->toSql();
  //// 左辺の$songsは$songLimitと同じ
  $problems = $this->problem();

  return view('songs.index', [
   'songs' => $songs,
   'problems' => $problems
  ]);
 }

 private function songPaginate($songs)
 {
  $songLimit = $songs->orderBy('id', 'desc')->paginate(3);
  return $songLimit;
 }

 private function problem()
 {
  $problems = Problem::all();
  return $problems;
 }
 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create(Problem $problem)
 {
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Song  $song
  * @return \Illuminate\Http\Response
  */
 public function show(Request $request, $id)
 {
  // select * from songs 
  // left join comments on songs.id = comments.song_id
  // left join 
  //where id = ?;
  // Method input does not exist.
  dd(Song::find($id));
  $song = Song::find($song->id);
  dd($song);
  //$song = Song::find($request->id);
  //$song = Song::with('user', 'comments', 'likes', 'comments.replies.user')->where('id', $id)->first();
  //dd($song);
  $song->load('user', 'books', 'comments', 'likes', 'comments.replies.user');
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
  $isLike = $song->likes()->where('user_id', $userAuth->id)->first();
  if (count($isLike) == 0) {
   $isLike == false;
  } else {
   $isLike == true;
  }
  return [$userAuth, $getLike, $isLike];
 }
}
