@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row justify-content-center">
  <div class="col-md-12">
   <div class="card">
    <div class="card-header">曲名一覧</div>
    {{-- mainの親がcard-body --}}
    <div class="card-body">
     <div class="mb-3">
      @include('components.top_search')
     </div>
     {{-- .songDataの親がmain --}}
     <div class="main">
      @foreach ($songs as $song)
      @if (!empty($song->file_name))
      <div class="songData">
       <a href="{{ route('songs.show',$song) }}">
        <img src="{{ asset('/storage/img/'.$song->file_name) }}" class="image">
       </a>
       @include('components.song_data')
      </div>
      @else
      <div class="songData">
       <a href="{{ route('songs.show',['id' => $song->id]) }}">
        <img src="{{ asset('/public_images/black_no_image.png')}}" class="image">
       </a>
       @include('components.song_data')
      </div>
      @endif
      @endforeach
     </div>
    </div>
    <p class="topPaginate">
     {{ $songs->appends(request()->input())->links() }}
    </p>
    @include('components.problem')
   </div>
  </div>
 </div>
</div>
@endsection
<script src="{{ mix('js/hoge.js') }}"></script>