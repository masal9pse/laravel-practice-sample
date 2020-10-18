<?php

namespace App\Http\Controllers;

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
   'password' => 'required'
  ]);

  $user = $request->user()->create([
   'name' => $request->name,
   'email' => $request->email,
   'password' => Hash::make($request->password)
  ]);

  return response()->json([
   'user' => $user,
   'message' => 'task has been created'
  ]);
 }


 public function book_store(Request $request)
 {
  $request->validate([
   'title' => 'required',
   'author' => 'required',
   'description' => 'required'
  ]);

  $book = $request->user()->create([
   'title' => $request->title,
   'author' => $request->author,
   'description' => Hash::make($request->description)
  ]);

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

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy($id)
 {
  //
 }
}
