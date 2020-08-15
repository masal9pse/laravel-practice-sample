@extends('layouts.app')
@section('content')
<div class="container">
 @guest
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
   {{Form::model($comment, ['route' => ['comments.destroy', $comment->id]])}}
   <a href="{{ route('replies.create', ['comment_id' => $comment->id]) }}" class="btn btn-info mt-5">返信する</a>
   <span class="text-danger">コメントを削除するにはログインしてください</span>
   {{Form::close()}}
  </div>
  <p class="panel-body">{{ $comment->comment }}</p>
  @foreach($comment->replies as $rep)
  @if($comment->id === $rep->comment_id)
  <div class="well">
   <span>
    登録者：{{ $rep->name }}
   </span>:
   <span class="rep_name"> {{ $rep->reply }} </span>
  </div>
  @endif
  @endforeach
  </p>
 </div>
 @endforeach
</div>
@else
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
  {{Form::model($comment, ['route' => ['comments.destroy', $comment->id]])}}
  <a href="{{ route('replies.create', ['comment_id' => $comment->id]) }}" class="btn btn-info mt-5">返信する</a>
  <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger">削除する</button>
  {{Form::close()}}
 </div>
 <p class="panel-body">{{ $comment->comment }}</p>
 @foreach($comment->replies as $rep)
 @if($comment->id === $rep->comment_id)
 <div class="well">
  登録者：{{ $rep->name }} |
  <span> {{ $rep->reply }} </span>
  <form action="{{ route('replies.destroy',$rep) }}" method="post">
   {{ csrf_field() }}
   <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger reply-rm-button">削除する</button>
  </form>
 </div>
 @endif
 @endforeach
 </p>
</div>
@endforeach
</div>
@endguest
@endsection