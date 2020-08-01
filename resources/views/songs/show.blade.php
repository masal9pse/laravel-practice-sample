@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  <h3 class="text-center form-group text-success">
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
   {{-- v-bindの参照先はとうぜんそのページと変数を返すSongController@show --}}
   <like :song-id="{{ json_encode($song->id) }}" :user-id="{{ json_encode($userAuth->id) }}"
    :default-Liked="{{ json_encode($defaultLiked) }}" :default-Count="{{ json_encode($defaultCount) }}">
   </like>
  </div>
 </div>

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
  <a href="{{ route('comments.create', ['song_id' => $song->id]) }}" class="btn btn-warning mt-5">コメントする</a>
 </div>
</div>
</div>
@endsection