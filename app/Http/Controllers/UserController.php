<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Song;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
 /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function index()
 {
  $users = User::all();
  // dd($users);
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
   //'password' => 'required'
   'password' => 'required|min:6|'
  ]);

  $user = User::create([
   'name' => $request->name,
   'email' => $request->email,
   //'password' => bcrypt($request->password)
   'password' => password_hash($request->password, PASSWORD_DEFAULT)
  ]);

  return response()->json([
   'user' => $user,
   'message' => 'task has been created'
  ]);
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
   'message' => 'task has been created'
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
