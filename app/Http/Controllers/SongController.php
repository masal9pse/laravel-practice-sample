<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Problem;

class SongController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index(Request $request, Song $songInstanse)
 {
  $search = $request->input('search');

  $songs = Song::query()->with('tags');

  $songInstanse->titleSearch($search, $songs);

  $songs = $songs->orderBy('id', 'desc')->paginate(3);
  $problems = Problem::all();

  return view('songs.index', [
   'songs' => $songs,
   'problems' => $problems
  ]);
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
 public function show($id)
 {
  $song = Song::find($id);
  $song->load('user', 'books', 'comments', 'likes', 'comments.replies.user');
  //dd($song);
  list($userAuth, $defaultCount, $defaultLiked) = $this->likeFunc($song);

  $params = [
   'userAuth' => $userAuth,
   'song' => $song,
   'defaultLiked' => $defaultLiked,
   'defaultCount' => $defaultCount
  ];

  return view('songs.show', $params);
 }

 private function likeFunc($song)
 {
  $userAuth = \Auth::user();
  $defaultCount = count($song->likes);
  $defaultLiked = $song->likes()->where('user_id', $userAuth->id)->first();
  if (count($defaultLiked) == 0) {
   $defaultLiked == false;
  } else {
   $defaultLiked == true;
  }
  return [$userAuth, $defaultCount, $defaultLiked];
 }
}
