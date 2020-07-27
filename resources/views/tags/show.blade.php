@extends('layouts.app_admin')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header">「{{ $tag->title }}」のブックマーク</div>
    <div class="card-body">
     <table class="table table-striped">
      <thead>
       <tr>
        <th>ID</th>
        <th>タイトル</th>
        <th>タグ</th>
        <th>アクション</th>
       </tr>
      </thead>
      @foreach($songs as $song)
      <tr>
       <td class="align-middle">{{ $song->id }}</td>
       <td class="align-middle"><a href="{{ $song->url }}">{{ $song->title }}</a></td>
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
     <div>
      <a href="{{ route('tags.index') }}" class="btn btn-secondary">戻る</a>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection