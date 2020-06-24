@extends('layouts.app_admin')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   @if ($message = Session::get('success'))
   <div class="text-primary" role="alert">
    <strong>
     {{ $message }}
    </strong>
   </div>
   @endif

   @include('components.admin_search')

   <div class="panel-heading">
    <p class="{{ Request::is('tags', 'tags/*') ? 'active' : '' }}">
     <a class="btn btn-danger" href="{{ route('tags.index') }}">タグを追加する</a>
    </p>
   </div>

   @include('components.form')

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