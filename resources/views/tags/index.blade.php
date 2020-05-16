@extends('layouts.app_admin')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header">タグ一覧</div>
    <div class="card-header">
     <a href="{{ route('songs.index') }}" class="btn btn-danger mt-5">トップページ</a>
    </div>
    <div class="card-body">
     <div class="mb-3">
      <a href="{{ route('tags.create') }}" class="btn btn-primary">新規登録</a>
     </div>
     {{-- @include('components.alert') --}}
     <table class="table table-striped">
      <thead>
       <tr>
        <th>ID</th>
        <th>タイトル</th>
        <th>アクション</th>
       </tr>
      </thead>
      @foreach($tags as $tag)
      <tr>
       <td class="align-middle">{{ $tag->id }}</td>
       <td class="align-middle">{{ $tag->title }}</td>
       <td class="align-middle">
        <div class="d-flex">
         <a href="{{ route('tags.show', $tag) }}" class="btn btn-secondary btn-sm">表示</a>
         <a href="{{ route('tags.edit', $tag) }}" class="btn btn-secondary btn-sm ml-1">編集</a>
         <form method="POST" action="{{ route('tags.destroy',['id' => $tag->id]) }}">
          {{ csrf_field() }}
          <input type="submit" value="削除" class="btn btn-danger btn-sm" onclick='return confirm("君は本当に削除するつもりかい？");'>
         </form>
        </div>
       </td>
      </tr>
      @endforeach
     </table>
     {{ $tags->links() }}
    </div>
   </div>
  </div>
 </div>
</div>
@endsection