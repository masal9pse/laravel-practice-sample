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
    @if($errors->has('comment'))
    @foreach($errors->get('comment') as $message)
    <div class="text-danger">
     {{ $message }}
    </div>
    @endforeach
    @endif
    <form action="{{ route('comments.store') }}" method="POST">
     {{ csrf_field() }}

     <div class="form-group">
      <label for="comment">コメントする</label>
      <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
     </div>

     <input type="hidden" name="user_id" value="{{ Auth::id() }}">

     {{-- どのユーザーがどの曲に対してコメントしているのかを把握できる --}}
     <input type="hidden" name="song_id" value="{{ $song_id }}">

     <button type="submit" class="btn btn-primary">投稿する</button>
    </form>
   </div>
  </div>
 </div>
</div>
@endsection