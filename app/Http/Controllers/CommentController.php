<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Comment;

class CommentController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  //
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
  $q = \Request::query();
  // dd($q['song_id']);
  return view('comments.create', [
   'song_id' => $q['song_id'],
  ]);
 }

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(CommentRequest $request)
 {
  $comment = new Comment;

  $input = $request->only($comment->getFillable());
  // dd($input);
  $comment = $comment->create($input);
  return redirect()->route('songs.show', ['id' => $comment->song_id]);
 }

 public function destroy(Comment $comment)
 {
  if (Auth::check()) {

   $reply = Reply::where(['comment_id' => $comment->id]);
   $comment = Comment::where(['user_id' => Auth::user()->id, 'id' => $comment->id]);
   if ($reply->count() > 0 && $comment->count() > 0) {
    $reply->delete();
    $comment->delete();
    // return 1;
    return redirect()->route('songs.show', ['id' => $comment->song->id]);
   } else if ($comment->count() > 0) {
    $comment->delete();
    // return 2;
    return redirect()->route('songs.show', ['id' => $comment->song->id]);
   } else {
    // return 3;
    return redirect()->route('songs.show', ['id' => $comment->song->id]);
   }
  }
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
  //
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {
  //
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, $id)
 {
  //
 }
}
