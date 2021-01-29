<p class="use-scss">
 <span class="scss-test01 scss-test02">タイトル</span>：
 {{--<a href="{{ route('songs.show',['id' => $song->id]) }}" class="yellow-color">{{ $song->title }}</a>--}}
 <a href="/songs/{{ $song->song_alias_id }}" class="yellow-color">{{ $song->title }}</a>
</p>
<div>
 タグ：
 @php
 $tags =
 DB::table('tags')->join('song_tag','tags.id','=','song_tag.tag_id')->where('song_id',$song->song_alias_id)->get();
 //dd($tag);
 foreach ($tags as $key => $tag) {
 echo $tag->title;
 echo "\t";
 }
 @endphp
 {{-- すでに認証ユーザーがいいねしているレコードがあったら「いいねを外す」ボタンを表示する --}}
 @if(App\Like::where('user_id',Auth::id())->where('song_id',$song->song_alias_id)->first())
 <a href="{{ route('likes.destroy', ['id' => $song->song_alias_id]) }}" class="btn btn-success btn-sm">いいねを外す
  <span class="badge">{{ App\Like::where('song_id',$song->song_alias_id)->count() }}</span></a>
 @else
 {{--<a href="{{ route('likes.store', $song->id) }}" class="btn btn-danger btn-sm">いいね--}}
 <a href="songs/like/{{ $song->song_alias_id }}" class="btn btn-danger btn-sm">いいね
  <span class="badge">{{ App\Like::where('song_id',$song->song_alias_id)->count() }}</span></a>
 @endif
</div>