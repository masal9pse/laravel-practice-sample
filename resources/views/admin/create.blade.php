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

   @include('components.song_store')
   <br>
   @include('components.admin_song_table')
   {{ $songs->links() }}
  </div>
 </div>
</div>
@endsection