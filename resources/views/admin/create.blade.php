@extends('layouts.app_admin')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-8">
   <div class="card">
    <div class="card-body">
     @if (session('status'))
     <div class="alert alert-success" role="alert">
      {{ session('status') }}
     </div>
     @endif
     @if ($message = Session::get('success'))
     <p class="text-primary">{{ $message }}</p>
     @endif
     {{ Form::open(['method' => 'get'],['route' => 'admin.create'],['class' => "form-inline my-2 my-lg-0"]) }}
     <input class="form-control mr-sm-2" name="search" type="search" placeholder="検索" aria-label="Search">
     <button class="btn btn-success my-2 my-sm-0" type="submit">検索する</button>
     {{Form::close()}}

     <form action="{{ url('/') }}" class="mt-3" method="GET">
      {{ csrf_field() }}
      <button class="btn btn-primary">トップページに戻る</button>
     </form>
     <div class="panel-heading">タスクを追加する</div>
     <p class="{{ Request::is('tags', 'tags/*') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('tags.index') }}">タグ</a>
     </p>
     @if($errors->any())
     <div class="alert alert-danger">
      @foreach($errors->all() as $message)
      <p>{{ $message }}</p>
      @endforeach
     </div>
     @endif

     createです
     <form action="{{ route('admin.store')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      　タイトル
      <input type="text" name="title">
      <br>
      歌詞
      <textarea name="detail" class="mt-5"></textarea>
      <br>
      <br>
      <input type="file" class="form-control" name="file_name">
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

      <input type="submit" value="登録する" class="btn btn-info">
     </form>
     {{-- {{Form::close()}} --}}
     @foreach ($songs as $song)
     <p class="mt-3">
      <a href="{{ route('admin.show',['id' => $song->id]) }}">
       {{ $song->title }}
      </a>
      {{Form::model($song, ['route' => ['admin.destroy', $song->id]])}}
      <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger">削除</button>
      {{Form::close()}}

      {{-- {{Form::model($song, ['route' => ['admin.edit', $song->id]])}} --}}
      <form action="{{ route('admin.edit',['id' => $song->id]) }}" class="mt-3" method="GET">
       {{ csrf_field() }}
       <button class="btn btn-success">更新</button>
      </form>
      {{-- {{Form::close()}} --}}
     </p>
     @endforeach
    </div>
    {{ $songs->links() }}
   </div>
  </div>
 </div>
</div>
@endsection