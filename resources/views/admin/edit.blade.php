@extends('layouts.app_admin')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-8">
   <div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
     @if (session('status'))
     <div class="alert alert-success" role="alert">
      {{ session('status') }}
     </div>
     @endif
     editです
     <form action="{{ route('admin.update',['id' => $song->id] )}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @if($errors->has('title'))
      @foreach($errors->get('title') as $message)
      <div class="text-danger">
       {{ $message }}
      </div>
      @endforeach
      @endif
      タイトル
      <input type="text" name="title" value="{{ $song->title }}">
      <br>
      @if($errors->has('detail'))
      @foreach($errors->get('detail') as $message)
      <div class="text-danger">
       {{ $message }}
      </div>
      @endforeach
      @endif
      歌詞
      <textarea name="detail">{{ $song->detail }}</textarea>
      <input type="file" class="form-control" name="file_name">
      {{-- タグ付け機能 --}}
      <div class="form-group row">
       <label for="inputTag" class="col-sm-2 col-form-label">タグ</label>
       <div class="col-sm-10">
        @foreach($tags as $key => $tag)
        <div class="form-check form-check-inline">
         <input type="checkbox" name="tags[]" value="{{ $key }}" id="tag{{ $key }}" @if(isset($song->tags) &&
         $song->tags->contains($key))
         checked
         @endif
         >
         <label for="tag{{ $key }}" class="form-check-label">{{ $tag }}</label>
        </div>
        @endforeach
       </div>
      </div>
      <input type="submit" value="更新する" class="btn btn-info">
    </div>
    </form>
   </div>
  </div>
  <div class="form-group">
   <form action="{{ route('admin.create') }}" class="mt-3" method="GET">
    {{ csrf_field() }}
    <button class="btn btn-primary">管理画面トップページに戻る</button>
   </form>
  </div>
 </div>
</div>
@endsection