<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  $name = Input::get('name');
  $email = Input::get('email');
  if (!empty($name)) {
   $queryName = $name;
   $users = User::select('*')
    ->where('name', 'LIKE', "%$queryName%")
    ->get();
  } elseif (!empty($email)) {
   $queryEmail = $email;
   $users = User::select('*')
    ->where('email', 'LIKE', "%$queryEmail%")
    ->get();
  } elseif (empty($name && $email)) {
   $users = User::select('*')->get();
  }
  return response()->json([
   'users' => $users
  ], 200);
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 //public function destroy($id)
 public function destroy(User $user)
 {
  $deleteUser = $user->delete();
  return response()->json([
   'deleteUser' => $deleteUser
  ]);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
 }


 public function like(Request $request)
 {
  DB::enableQueryLog();
  $user = User::find($request->input('id'));
  $result = $user->songs()->attach($request->song_id);
  DB::getQueryLog();

  return response()->json([
   'message' => (int)$request->id,
   'user' => $user,
   'result' => $result
  ]);
 }

 public function unlike()
 {
 }
 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
 public function store(Request $request)
 {
  $request->validate([
   'name' => 'required',
   'email' => 'required',
   'password' => 'required|min:6|'
  ]);

  $user = User::create([
   'name' => $request->name,
   'email' => $request->email,
   'password' => password_hash($request->password, PASSWORD_DEFAULT)
  ]);

  return response()->json([
   'user' => $user,
   'message' => '投稿に成功しました。'
  ], 200);
 }


 public function book_store(Request $request)
 {
  $request->validate([
   'song_id' => 'nullable',
   'title' => 'required',
   'author' => 'required',
   'description' => 'nullable',
   'thumbnail' => 'nullable'
  ]);

  $book = Book::create($request->only(['song_id', 'title', 'author', 'description', 'thumbnail']));
  //$book->save(); // なくてもいい

  return response()->json([
   'book' => $book,
   'message' => '本を投稿しました。'
  ]);
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
  $user = User::find($id);
  //$songs = $user->songs();
  $user->load('songs');
  return $user;
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
  $request->validate([
   'name' => 'nullable',
   'email' => 'nullable',
   'password' => 'nullable'
  ]);

  $user = User::find($id);
  $user->name = $request->name;
  $user->email = $request->email;
  $user->password = password_hash($request->password, PASSWORD_DEFAULT);
  $user->save();

  return response()->json([
   'user' => $user,
   'message' => '投稿を更新しました。'
  ]);
 }
}
