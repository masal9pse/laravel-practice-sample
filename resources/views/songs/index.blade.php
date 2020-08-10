@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header">曲名一覧</div>
    <div class="card-body">
     <div class="mb-3">
      @include('components.top_search')
     </div>
     <div class="main">
      @foreach ($songs as $song)
      @if (!empty($song['file_name']))
      <div>
       <img src="{{ asset('/storage/img/'.$song->file_name) }}" class="image">
       タイトル：<a href="{{ route('songs.show',$song) }}">{{ $song->title }}</a>
       <div>
        タグ：
        @foreach($song->tags as $tag)
        <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->title }}</a>
        @unless($loop->last)
        ,
        @endunless
        @endforeach
       </div>
      </div>
      @else
      <div>
       <img src="{{ asset('/public_images/black_no_image.png')}}" class="image">
       タイトル：<a href="{{ route('songs.show',$song) }}">{{ $song->title }}</a>
       <div>
        タグ：
        @foreach($song->tags as $tag)
        <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->title }}</a>
        @unless($loop->last)
        ,
        @endunless
        @endforeach
       </div>
      </div>
      @endif
      @endforeach
     </div>
    </div>
   </div>
   <p>
    {{ $songs->links() }}
   </p>
   @include('components.problem')

  </div>
 </div>
</div>
</div>
</div>
@endsection