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
   <img src="{{ asset('/storage/img/'.$song->file_name) }}">
   @else
   <img src="{{ asset('/public_images/black_no_image.png')}}">
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
 </div>

 @foreach ($song->comments as $comment)
 <div class="panel panel-success">
  <div class="panel-heading">
   登録者:{{ $comment->user->name }}
   <a href="{{ route('replies.create', ['comment_id' => $comment->id]) }}" class="btn btn-info mt-5">返信する</a>
   {{-- <form action="{{ route('comments.destroy',['song_id' => $song->id]) }}" class="mt-3" method="POST"> --}}
   <form action="{{ route('comments.destroy') }}" class="mt-3" method="DELETE">
    {{ csrf_field() }}
    <button class="btn btn-danger">削除する</button>
   </form>
  </div>
  <p class="panel-body">{{ $comment->comment }}</p>
  @foreach($comment->replies as $rep)
  @if($comment->id === $rep->comment_id)
  <div class="well">
   登録者：{{ $rep->name }} |
   <span> {{ $rep->reply }} </span>
  </div>
  @endif
  @endforeach
  </p>
 </div>
 @endforeach
</div>
@endsection