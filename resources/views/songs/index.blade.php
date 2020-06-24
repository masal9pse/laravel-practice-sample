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

     <form action="{{ route('songs.store')}}" method="post" class="col-3">
      {{ csrf_field() }}
      <h3>問題や感想があれば報告お願いします</h3>
      <div class="form-group">
       @if($errors->has('name'))
       @foreach($errors->get('name') as $message)
       <div class="text-danger">
        {{ $message }}
       </div>
       @endforeach
       @endif
       <label for="exampleInputName2">名前</label>
       <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="名前">
      </div>
      <div class="form-group">
       @if($errors->has('problem'))
       @foreach($errors->get('problem') as $message)
       <div class="text-danger">
        {{ $message }}
       </div>
       @endforeach
       @endif
       <textarea name="problem" class="form-control mb-5" rows="3" placeholder="問題、意見お願いします"></textarea>
      </div>
      <div class="form-group">
       <button type="submit" class="btn btn-warning">投稿</button>
      </div>
     </form>
     @foreach ($problems as $problem)
     <div class="form-group">
      <span>名前: {{ $problem->name }}</span>
      <div class="form-group">感想: {{ $problem->problem }}</div>
     </div>
     @endforeach
    </div>
   </div>
  </div>
 </div>
</div>
@endsection