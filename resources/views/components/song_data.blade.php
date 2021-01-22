<p class="use-scss">
 <span class="scss-test01 scss-test02">タイトル</span>：<a href="{{ route('songs.show',$song) }}"
  class="yellow-color">{{ $song->title }}</a>
</p>
<div>
 タグ：
 @foreach($song->tags as $tag)
 <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->title }}</a>
 @unless($loop->last)
 ,
 @endunless
 @endforeach
 {{--<div>--}}
 @if($song->is_liked_by_auth_user())
 <a href="{{ route('likes.destroy', ['id' => $song->id]) }}" class="btn btn-success btn-sm">いいね<span
   class="badge">{{ $song->likes->count() }}</span></a>
 @else
 <a href="{{ route('likes.store', ['id' => $song->id]) }}" class="btn btn-danger btn-sm">いいね<span
   class="badge">{{ $song->likes->count() }}</span></a>
 @endif
</div>