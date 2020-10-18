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
   <br>
   @include('components.song_store')
   @include('components.admin_song_table')
   {{ $songs->links() }}
  </div>
 </div>
</div>
@endsection