@extends('layouts.app_admin')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   @if (session('status'))
   <div class="alert alert-success" role="alert">
    {{ session('status') }}
   </div>
   @endif
   @if ($message = Session::get('success'))
   <p class="text-primary">{{ $message }}</p>
   @endif

   @include('components.admin_search')

   <div class="panel-heading">
    <p class="{{ Request::is('tags', 'tags/*') ? 'active' : '' }}">
     <a class="btn btn-danger" href="{{ route('tags.index') }}">タグを追加する</a>
    </p>
   </div>

   <form action="{{ route('admin.store')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="panel panel-primary">
     <div class="panel-heading">
      <h5 class="panel-title">
       歌詞登録
      </h5>
     </div>
     <br>
     <div class="penel-body">
      <label for="inputTitle" class="col-sm-2 col-form-label">タイトル</label>
      <div class="col-sm-10">
       @if($errors->has('title'))
       @foreach($errors->get('title') as $message)
       <div class="text-danger">
        {{ $message }}
       </div>
       @endforeach
       @endif
       <input type="text" name="title" class="form-control" placeholder="タイトル">
      </div>
      <br>
      <label for="inputDescription" class="col-sm-2 col-form-label">
       歌詞
      </label>
      <div class="col-sm-10">
       @if($errors->has('detail'))
       @foreach($errors->get('detail') as $message)
       <div class="text-danger">
        {{ $message }}
       </div>
       @endforeach
       @endif
       <textarea name="detail" class="form-control" placeholder="歌詞を入力してください"></textarea>
      </div>
      <br>
      <input type="file" class="form-control" name="file_name">
      <br>
      {{-- <div class="form-group row"> --}}
      <label for="inputTag" class="col-sm-2 col-form-label">タグをつける</label>
      <div class="col-sm-10">
       <div class="form-check form-check-inline">
        @foreach($tags as $key => $tag)
        <input type="checkbox" name="tags[]" value="{{ $key }}" id="tag{{ $key }}" @if(isset($song->tags) &&
        $song->tags->contains($key))
        checked
        @endif
        >
        <label for="tag{{ $key }}" class="form-check-label">{{ $tag }}</label>
        @endforeach
       </div>
      </div>
      <br>
      <input type="submit" value="登録する" class="btn btn-info">
     </div>
    </div>
   </form>

   <br>
   <br>
   <div>
    @foreach ($songs as $song)
    <p class="mt-3">
     <a href="{{ route('admin.show',['id' => $song->id]) }}">
      {{ $song->title }}
     </a>
     {{Form::model($song, ['route' => ['admin.destroy', $song->id]])}}
     <button onclick="return confirm('本当に削除しますか？')" class="btn btn-danger">削除</button>
     {{Form::close()}}

     <form action="{{ route('admin.edit',['id' => $song->id]) }}" class="mt-3" method="GET">
      {{ csrf_field() }}
      <button class="btn btn-success">更新</button>
     </form>
    </p>
    @endforeach
    {{ $songs->links() }}
   </div>
  </div>
 </div>
</div>
@endsection