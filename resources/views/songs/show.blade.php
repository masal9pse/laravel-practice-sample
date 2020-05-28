@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  {{ $song->detail }}
  @if (!empty($song['file_name']))
  {{-- asset関数の引数は/publicの中をデフォルトで参照する --}}
  <p><img src="{{ asset('/storage/img/'.$song->file_name) }}"></p>
  @else
  <p class="mb-3">まだ画像は登録されていません</p>
  @endif

  <like :song-id="{{ json_encode($song->id) }}" :user-id="{{ json_encode($userAuth->id) }}"
   :default-Liked="{{ json_encode($defaultLiked) }}" :default-Count="{{ json_encode($defaultCount) }}"></like>

  <div class="mt-5">
   <div class="card-title mt-5">コメント一覧</div>
   @foreach ($song->comments as $comment)
   <div class="card">
    <p class="card-text">
     登録者:{{ $comment->user->name }}
    </p>
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