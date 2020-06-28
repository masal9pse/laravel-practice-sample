<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Problem;
use App\Http\Requests\ProblemRequest;
use App\Like;

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

  // もしキーワードがあったら
  if ($search !== null) {
   // 半角スペースを半角に
   $search_split = mb_convert_kana($search, 's');

   // 空白で区切る
   $search_split2 = preg_split('/[\s]+/', $search_split, -1, PREG_SPLIT_NO_EMPTY);

   foreach ($search_split2 as $value) {
    $songs->where('title', 'like', '%' . $value . '%');
   }
  }

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
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(ProblemRequest $request)
 {
  $problem = Problem::create($request->only(['name', 'problem']));
  $problem->save();
  return redirect()->route('songs.index');
  // return redirect()->route('/');
 }

 /**
  * Display the specified resource.
  *
  * @param  \App\Song  $song
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
  // $userAuth = Auth::user(); // 認証ユーザー取得
  $song = Song::find($id);
  $like = new Like();
  $song->load('user', 'comments', 'user', 'likes');

  $defaultCount = count($song->likes);
  $defaultLiked = $song->likes->where('user_id', $song->user()->id)->first();
  if (count($defaultLiked) == 0) {
   $defaultLiked == false;
  } else {
   $defaultLiked == true;
  }

  $params = [
   // 'userAuth' => $userAuth,
   'song' => $song,
   'like' => $like,
   'defaultLiked' => $defaultLiked,
   'defaultCount' => $defaultCount
  ];

  return view('songs.show', $params);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Song  $song
  * @return \Illuminate\Http\Response
  */
 public function like(Request $request, Song $song)
 {
  $song->likes()->detach($request->user()->id);
  $song->likes()->attach($request->user()->id);

  return [
   'id' => $song->id,
   'countLikes' => $song->count_likes,
  ];
 }

 public function unlike(Request $request, Article $song)
 {
  $song->likes()->detach($request->user()->id);

  return [
   'id' => $song->id,
   'countLikes' => $song->count_likes,
  ];
 }
 public function edit(Song $song)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Song  $song
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, Song $song)
 {
  //
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Song  $song
  * @return \Illuminate\Http\Response
  */
 public function destroy(Song $song)
 {
  //
 }
}
