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
     <table class="table table-striped">
      <thead>
       <tr>
        <th>タイトル</th>
        <th>タグ</th>
        <th>歌詞</th>
       </tr>
      </thead>
      @foreach($songs as $song)
      <tr>
       <td class="align-middle">
        <a href="{{ route('songs.show',$song) }}">{{ $song->title }}
        </a>
       </td>
       <td class="align-middle">
        @foreach($song->tags as $tag)
        <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->title }}</a>
        @unless($loop->last)
        ,
        @endunless
        @endforeach
       </td>
       <td class="align-middle">
        <a href="{{ route('songs.show', $song) }}" class="btn btn-secondary btn-sm">表示</a>
       </td>
      </tr>
      @endforeach
     </table>
     {{ $songs->links() }}

     @include('components.problem')

    </div>
   </div>
  </div>
 </div>
</div>
@endsection