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
     @if($errors->any())
     <div class="alert alert-danger">
      @foreach($errors->all() as $message)
      <p>{{ $message }}</p>
      @endforeach
     </div>
     @endif
     editです
     <form action="{{ route('tags.update',['id' => $tag->id] )}}" method="post">
      {{ csrf_field() }}
      @include('tags.fields')
     </form>
    </div>
   </div>
  </div>
 </div>
 <p class="{{ Request::is('tags', 'tags/*') ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('tags.index') }}">タグ</a>
 </p>
</div>
@endsection