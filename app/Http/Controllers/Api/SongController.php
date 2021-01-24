<?php

namespace App\Http\Controllers\Api;

use App\Models\Song;
use App\Http\Controllers\Controller; // 大事！！
use App\Http\Requests\CreateSongTask;

class SongController extends Controller
{
 //public function store(CreateSongTask $request)
 //{
 // $last_song_insert_id = $this->songInsert($request);

 // $this->tagInsert($last_song_insert_id, $_POST['tags']);
 //}

 public function store(CreateSongTask $request)
 {
  //$song = Song::create($request->only(['title', 'detail', 'file_name']));
  $song = Song::create($request->only(['title', 'detail']));

  if ($request->file('file_name')) {
   $song->file_name = $request->file('file_name')->store('public/img');
  }

  $song->file_name = basename($song->file_name);

  $song->save();
  $song->tags()->sync($request->tags);
  return [$song];
 }

 private function songInsert($request)
 {
  $song = Song::create($request->only(['title', 'detail', 'file_name']));

  if ($request->file('file_name')) {
   $song->file_name = $request->file('file_name')->store('public/img');
  }

  $song->file_name = basename($song->file_name);
  $song->save();
  $last_song_insert_id = $song->id;

  return $last_song_insert_id;
 }

 private function tagInsert($last_insert_id, $tags)
 {
  $db = DB::connection()->getPdo();
  $sql = "INSERT INTO song_tag(song_id,tag_id) VALUES (:song_id,:tag_id)";
  $tag_stmt = $db->prepare($sql);
  foreach ($tags as $tag) {
   $tag_stmt->bindValue(':song_id', $last_insert_id);
   $tag_stmt->bindValue(':tag_id', $tag);
   $tag_stmt->execute();
  }
 }

 public function destroy($id)
 {
  $song = Song::find($id);
  $song->delete();
  return $song;
 }
}
