<p class="use-scss">
 <span class="scss-test01 scss-test02">タイトル</span>：
 <a href="/songs/{{ $song->id }}" class="yellow-color">{{ $song->title }}</a>
</p>
<div>
 タグ：
 {{-- ()をつけないとなぜか実装できる=>ここを質問 --}}
 @foreach ($song->tags as $tag)
 {{ $tag->title }}
 @endforeach
 <div>
  {{--@if ($song->likes->where('song_id',$song->id)->where('user_id',Auth::id())->first())--}}
  @if ($song->likes->where('user_id',Auth::id())->first())
  <a href="{{ route('likes.destroy', ['id' => $song->id]) }}" class="btn btn-success btn-sm">いいねを外す
   <span class="badge">{{ $song->likes->where('song_id',$song->id)->count() }}</span></a>
  @else
  <a href="songs/like/{{ $song->id }}" class="btn btn-danger btn-sm">いいね
   <span class="badge">{{ $song->likes->where('song_id',$song->id)->count() }}</span></a>
  @endif
 </div>
</div>