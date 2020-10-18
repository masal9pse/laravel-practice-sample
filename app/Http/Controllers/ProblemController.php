<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problem;
use App\Http\Requests\ProblemRequest;

class ProblemController extends Controller
{
 public function store(ProblemRequest $request)
 {
  $problem = Problem::create($request->only(['name', 'problem']));
  $problem->save();
  return redirect()->route('songs.index');
 }
}
