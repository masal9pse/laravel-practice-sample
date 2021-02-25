<?php

namespace App\Http\Controllers\Api;

use App\Models\Song;
use App\Http\Controllers\Controller; // 大事！！
use App\Http\Requests\CreateSongTask;
use App\Services\SongService;
use Illuminate\Http\Request; // これ以外のRequestオブジェクトをuseするとfileメソッドなどが使えずエラーになった

class SongController extends Controller
{
 protected $songService;
 public function __construct(SongService $song_service)
 {
  $this->songService = $song_service;
 }

 //public function index(Request $request)
 public function index()
 {
  $higedan = new SongService;
  $higedans = $higedan->higedan();
  $songs = $this->songService->getSong();
  return [$higedans, $songs];
 }

 public function store(CreateSongTask $request)
 {
  $song = Song::create([
   // 左側の値をリクエストとしてフロント側でも使う
   // 右側はフロント側と関係ない
   //'title' => $request->change_title,
   'title' => $request->masato,
   //'title2' => $request->title,
   'detail' => $request->detail,
  ]);

  return response()->json([
   'song' => $song,
   'message' => '投稿に成功しました。'
  ], 200);
 }

 public function fileRequest(Request $request)
 {
  try {
   $file = $request->file('image')->store('img');
   //$data = json_decode($request->input()['data']);
   $data = json_decode($request->input(['data']));
   //$data = $request->input(['data']); // json_decodeを使わないとこんな感じのよくわからないjsonが返ってくる "datas": "{\"test1\":\"1\",\"test2\":\"2\",\"test3\":\"3\"}",


   return response()->json([
    'file' => $file,
    'datas' => $data,
    'success' => 'file upload success'
   ], 500);
  } catch (Exception $e) {
   return response($e->getMessage(), 500);
  }
 }
}
