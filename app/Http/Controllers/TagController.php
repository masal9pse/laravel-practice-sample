<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;

class TagController extends Controller
{
 /**
  * @return \Illuminate\View\View
  */
 public function index()
 {
  $tags = Tag::orderBy('id', 'desc')->paginate(20);
  return view('tags.index', compact('tags'));
 }

 /**
  * @return \Illuminate\View\View
  */
 public function create(Tag $tag)
 {
  // dd($tag);
  return view('tags.create');
 }

 /**
  * @param TagRequest $request
  * @return \Illuminate\Http\RedirectResponse
  */
 public function store(TagRequest $request)
 {
  Tag::create($request->all());
  return redirect()
   ->route('tags.index')
   ->with('status', 'タグを登録しました。');
 }

 /**
  * @param Tag $tag
  * @return \Illuminate\View\View
  */
 public function show(Tag $tag)
 {
  $songs = $tag->songs()->paginate(20);
  // dd($songs);
  return view('tags.show', compact('tag', 'songs'));
 }

 /**
  * @param Tag $tag
  * @return \Illuminate\View\View
  */
 public function edit(Tag $tag)
 {
  return view('tags.edit', compact('tag'));
 }

 /**
  * @param TagRequest $request
  * @param Tag $tag
  * @return \Illuminate\Http\RedirectResponse
  */
 public function update(TagRequest $request)
 {
  // dd($tag);
  $tag = new Tag;
  // $input = $request->only($tag->getFillable());
  $tag->title = $request->title;
  $tag->save();
  return redirect()
   ->route('tags.edit', ['id' => $tag->id])
   ->with('status', 'タグを更新しました。');
 }

 /**
  * @param Tag $tag
  * @return \Illuminate\Http\RedirectResponse
  * @throws \Exception
  */
 public function destroy($id)
 {
  $tag = Tag::findOrFail($id);
  $tag->delete($id);
  $tag->songs()->detach();
  return redirect()
   ->route('tags.index')
   ->with('status', 'タグを削除しました。');
 }
}
