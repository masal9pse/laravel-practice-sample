@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
  {{ $song->detail }}
  @if (!empty($song['file_name']))
  <p><img src="{{ asset('/storage/img/'.$song->file_name) }}"></p>
  @else
  {{-- なぜかスタイルが適用されない --}}
  <p class="mb-3">まだ画像は登録されていません</p>
  @endif

  @if (Auth::check())
  @if ($like)
  <!-- いいね取り消しフォーム -->
  {{ Form::model($song, array('action' => array('LikesController@destroy', $song->id, $like->id))) }}
  <button type="submit">
   ♡ いいね {{ $song->likes_count }}
  </button>
  {!! Form::close() !!}
  @else
  <!-- いいねフォーム -->
  {{ Form::model($song, array('action' => array('LikesController@store', $song->id))) }}
  <button type="submit" class="p-3">
   + いいね {{ $song->likes_count }}
  </button>
  {!! Form::close() !!}
  @endif
  @endif

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