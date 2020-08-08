@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  <h3 class="text-center form-group">
   {{ $song->title }}
  </h3>
  <div class="form-group text-primary">
   {{ $song->detail }}
  </div>

  <div class="form-group">
   @if (!empty($song['file_name']))
   <p><img src="{{ asset('/storage/img/'.$song->file_name) }}"></p>
   @else
   <p class="mb-3">まだ画像は登録されていません</p>
   @endif
  </div>

  <div class="form-group">
   <like :song-id="{{ json_encode($song->id) }}" :user-id="{{ json_encode($userAuth->id) }}"
    :default-Liked="{{ json_encode($defaultLiked) }}" :default-Count="{{ json_encode($defaultCount) }}">
   </like>
  </div>
 </div>

 <div class="form-group">
  <span>コメント一覧</span>
  <a href="{{ route('comments.create', ['song_id' => $song->id]) }}" class="btn btn-warning mt-5">コメントする</a>
  <a href="{{ route('replies.create', ['comment_id' => $song->id]) }}" class="btn btn-info mt-5">コメントする</a>
 </div>

 @foreach ($song->comments as $comment)
 <div class="panel panel-success">
  <div class="panel-heading">
   登録者:{{ $comment->user->name }}
  </div>
  <p class="panel-body">{{ $comment->comment }}</p>
 </div>
 @endforeach
</div>
@endsection