@extends('layouts.app')

@section('content')
<div class="container">
 <div class="card-body">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
   {{ session('status') }}
  </div>
  @endif

  <div class="card">
   <div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
     <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
    @endif
    <form action="{{ route('replies.store') }}" method="POST">
     {{ csrf_field() }}

     <div class="form-group">
      <label for="reply">返信を返す</label>
      <textarea class="form-control" rows="5" id="comment" name="reply"></textarea>
     </div>

     {{-- <input type="hidden" name="song_id" value="{{ $song_id }}"> --}}

     <input type="hidden" name="comment_id" value="{{ $comment_id }}">

     <button type="submit" class="btn btn-danger">投稿する</button>
    </form>
   </div>
  </div>
 </div>
</div>
@endsection