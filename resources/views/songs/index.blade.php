@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header">曲名一覧</div>
    <div class="card-body">
     <div class="mb-3">
      <form method="GET" action="{{ route('songs.index') }}" class="form-inline my-2 my-lg-0">
       <input class="form-control mr-sm-2" name="search" type="search" placeholder="検索" aria-label="Search">
       <button class="btn btn-success my-2 my-sm-0" type="submit">検索する</button>
      </form>
     </div>
     <table class="table table-striped">
      <thead>
       <tr>
        <th>ID</th>
        <th>タイトル</th>
        <th>タグ</th>
        <th>歌詞</th>
       </tr>
      </thead>
      @foreach($songs as $song)
      <tr>
       <td class="align-middle">{{ $song->id }}</td>
       <td class="align-middle"><a href="{{ route('songs.show',$song) }}">{{ $song->title }}</a></td>
       <td class="align-middle">
        @foreach($song->tags as $tag)
        <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->title }}</a>
        @unless($loop->last)
        ,
        @endunless
        @endforeach
       </td>
       <td class="align-middle">
        <div class="d-flex">
         <a href="{{ route('songs.show', $song) }}" class="btn btn-secondary btn-sm">表示</a>
        </div>
       </td>
      </tr>
      @endforeach
     </table>
     {{ $songs->links() }}
    </div>
   </div>
  </div>
 </div>
</div>
@endsection