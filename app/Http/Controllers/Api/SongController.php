<?php

namespace App\Http\Controllers\Api;

use App\Models\Song;
use App\Http\Controllers\Controller; // 大事！！
use App\Http\Requests\CreateSongTask;

class SongController extends Controller
{
 public function index()
 {
  $song = Song::all();
  return $song;
 }

 public function store(CreateSongTask $request)
 {
  $song = Song::create($request->only(['title', 'detail', 'file_name']));
  //$song = Song::create($request->only(['title', 'detail']));

  if ($request->file('file_name')) {
   $song->file_name = $request->file('file_name')->store('public/img');
  }

  $song->file_name = basename($song->file_name);

  $song->save();
  $song->tags()->sync($request->tags);
  //return [$song];
 }

 public function destroy($id)
 {
  $song = Song::find($id);
  $song->delete();
  return $song;
 }
}
