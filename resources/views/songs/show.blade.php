@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  <div class="form-group">
   {{ $song->detail }}
  </div>

  <div class="form-group">
   @if (!empty($song['file_name']))
   <p><img src="{{ asset('/storage/img/'.$song->file_name) }}"></p>
   @else
   <p class="mb-3">まだ画像は登録されていません</p>
   @endif
  </div>

  {{-- <div class="form-group"> --}}
  {{-- <like :initial-is-liked-by='@json($song->isLikedBy(Auth::user()))' :initial-count-likes='@json($song->count_likes)'
    :authorized='@json(Auth::check())' endpoint="{{ route('songs.like', ['song' => $song]) }}">
  </like>
 </div> --}}

 <div class="form-group">
  <div class="from-group">コメント一覧</div>
  @foreach ($song->comments as $comment)
  <div class="form-group">
   <span class="card-text">
    登録者:{{ $comment->user->name }}
   </span>
   <div class="card-body">
    <p class="card-text">{{ $comment->comment }}</p>
   </div>
  </div>
  @endforeach
  <a href="{{ route('comments.create', ['song_id' => $song->id]) }}" class="btn btn-primary mt-5">コメントする</a>
 </div>
</div>
</div>
@endsection