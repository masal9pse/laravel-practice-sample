<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Http\Requests\CreateSongTask;
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
 public function create(Request $request)
 {
  $search = $request->input('search');
  $songs = DB::table('songs');
  $songs->orderBy('created_at', 'desc');
  $songs = $songs->paginate(10);
  if ($search) {
   $songs = DB::table('songs')->where('title', 'like', '%' . $search . '%')->orWhere('detail', 'like', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(10);
  }
  $tags = Tag::pluck('title', 'id')->toArray();
  // dd($tags);
  return view('admin.create', [
   'songs' => $songs,
   'tags' => $tags
  ]);
 }

 public function store(CreateSongTask $request)
 {
  //dd($request->query('file_name')); // null;
  //dd($request->input('file_name')); // error
  //dd($request->file_name); // success
  //dd($request->file('file_name')); // success
  Song::create([
   // inputで指定しても直接指定してもどっちの書き方でもおけ
   'title' => $request->title,
   'detail' => $request->input('detail'),
   'file_name' => $request->file('file_name')->getClientOriginalName()
  ]);

  if ($request->file_name) {
   $request->file('file_name')->storeAs('public/img', $request->file('file_name')->getClientOriginalName());
  }

  return redirect()->route('admin.create')->with([
   'success' => 'ファイルを保存しました',
  ]);
 }

 private function tagInsert($last_insert_id)
 {
  $db = DB::connection()->getPdo();
  $sql = "INSERT INTO song_tag(song_id,tag_id) VALUES (:song_id,:tag_id)";
  $tag_stmt = $db->prepare($sql);
  foreach ($_POST['tags'] as $tag) {
   $tag_stmt->bindValue(':song_id', $last_insert_id);
   $tag_stmt->bindValue(':tag_id', $tag);
   $tag_stmt->execute();
  }
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

 public function userList()
 {
  return view('admin.userList');
 }
}
