<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Http\Requests\CreateSongTask;
use App\Http\Requests\TagRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Tag;

class SongController extends Controller
{
 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function __construct()
 {
  $this->middleware('auth:admin');
 }

 /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */
 public function create(Request $request, Song $songInstanse)
 {
  $search = $request->input('search');
  $songs = DB::table('songs');

  $songInstanse->titleSearch($search, $songs);

  $songs->select('*');
  $songs->orderBy('created_at', 'desc');
  $songs = $songs->paginate(10);
  $tags = Tag::pluck('title', 'id')->toArray();
  // dd($tags);
  return view('admin.create', [
   'songs' => $songs,
   'tags' => $tags
  ]);
 }

 public function store(CreateSongTask $request)
 {
  $song = Song::create($request->only(['title', 'detail', 'file_name']));

  if ($request->file('file_name')) {
   $song->file_name = $request->file('file_name')->store('public/img');
  }

  $song->file_name = basename($song->file_name);

  $song->save();
  $song->tags()->sync($request->tags);
  return redirect()->route('admin.create')->with(['success' => 'ファイルを保存しました']);
 }

 public function show($id)
 {
  $song = Song::find($id);

  return view('admin.show', [
   'song' => $song
  ]);
 }

 public function edit($id)
 {
  $song = Song::find($id);
  $song->load('tags');
  // dd($song);
  $tags = Tag::pluck('title', 'id')->toArray();
  return view('admin.edit', compact('song', 'tags'));
 }

 public function update(CreateSongTask $request, $id)
 {
  $song = Song::find($id);

  $song->title = $request->input('title');
  $song->detail = $request->input('detail');
  // ここから画像編集機能
  if ($request->file('file_name')) {
   $song->file_name = $request->file('file_name')->store('public/img');
  }

  $song->file_name = basename($song->file_name);
  $song->save();
  $song->tags()->sync($request->tags);
  // dd($song);
  return redirect()->route('admin.create');
 }

 public function destroy($id)
 {
  $song = Song::find($id);
  // dd($song);
  $song->delete();

  return redirect()->route('admin.create');
 }
}
