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
 public function index(Request $request)
 {
  $search = $request->input('search');

  $songs = Song::query()->with('tags');
  // dd($songs);

  if ($request->has('search') && $songs != null) {
   $songs->where('title', 'like', '%' . $search . '%')->get();
  } else {
   $songs->orderBy('id', 'desc')->paginate(4);
  }

  $songs = $songs->orderBy('id', 'desc')->paginate(4);
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
  $userAuth = \Auth::user();
  $song = Song::find($id);
  $song->load('user', 'comments', 'likes', 'comments.replies');
  // dd($song);
  $defaultCount = count($song->likes);
  $defaultLiked = $song->likes()->where('user_id', $userAuth->id)->first();
  if (count($defaultLiked) == 0) {
   $defaultLiked == false;
  } else {
   $defaultLiked == true;
  }

  $params = [
   'userAuth' => $userAuth,
   'song' => $song,
   'defaultLiked' => $defaultLiked,
   'defaultCount' => $defaultCount
  ];

  return view('songs.show', $params);
 }
}
