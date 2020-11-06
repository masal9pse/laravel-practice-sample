タイトル：<a href="{{ route('songs.show',$song) }}">{{ $song->title }}</a>
<div>
 タグ：
 @foreach($song->tags as $tag)
 <a href="{{ route('tags.show', $tag->id) }}">{{ $tag->title }}</a>
 @unless($loop->last)
 ,
 @endunless
 @endforeach
 {{--<div class="col-md-3">--}}
 <form action="{{ route('like.store',$song->id) }}" method="POST">
  {{ csrf_field() }}
  <input type="submit" value="&#xf164;いいね" class="fas btn btn-success">
 </form>
 {{--</div>--}}
 {{--<div class="col-md-3">--}}
 <form action="{{ route('unlike.destroy', $song) }}" method="POST">
  {{ csrf_field() }}
  <input type="submit" value="&#xf164;いいね取り消す" class="fas btn btn-danger">
 </form>
 {{--</div>--}}
</div>