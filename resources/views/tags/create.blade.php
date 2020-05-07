@extends('layouts.app')

@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-10">
   <div class="card">
    <div class="card-header">タグ登録</div>
    <div class="card-body">
     @include('components.alert')
     <form method="POST" action="{{ route('tags.store') }}">
      {{ csrf_field() }}
      @include('tags.fields')
     </form>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection