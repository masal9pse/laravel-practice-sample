{{--<form action="{{ route('admin.store')}}" method="post" enctype="multipart/form-data">
{{ csrf_field() }}--}}
<div class="panel panel-primary">
 <div class="panel-heading">
  <h5 class="panel-title">
   歌詞登録
  </h5>
 </div>
 <br>
 <div class="penel-body">
  <label for="inputTitle" class="col-sm-2 col-form-label">タイトル</label>
  <div class="col-sm-10">
   @if($errors->has('title'))
   @foreach($errors->get('title') as $message)
   <div class="text-danger">
    {{ $message }}
   </div>
   @endforeach
   @endif
   <input type="text" id="title-data" name="title" class="form-control" placeholder="タイトル">
  </div>
  <br>
  <br>
  <label for="inputDescription" class="col-sm-2 col-form-label">
   歌詞
  </label>
  <div class="col-sm-10">
   @if($errors->has('detail'))
   @foreach($errors->get('detail') as $message)
   <div class="text-danger">
    {{ $message }}
   </div>
   @endforeach
   @endif
   <div class="form-group">
    <textarea name="detail" id="detail-data" class="form-control" rows="10" placeholder="歌詞を入力してください"></textarea>
   </div>
  </div>
  <br>
  <br>
  <input type="file" id="image-data" class="form-control" name="file_name">
  <br>
  <div>
   <div id="tags-data" class="form-check form-check-inline">
    @foreach($tags as $key => $tag)
    {{-- pluckメソッドですでにキーとバリューを使用しているのでtitleを指定する必要はない --}}
    {{--<input type="checkbox" name="tags[]" value="{{ $key }}" id="tag{{ $key }}" @if(isset($song->tags) &&--}}
    <input type="checkbox" name="tags[]" value="{{ $key }}" id="tag-data" @if(isset($song->tags) &&
    $song->tags->contains($key))
    checked
    @endif
    >
    <label for="tag{{ $key }}" class="form-check-label">{{ $tag }}</label>
    @endforeach
   </div>
  </div>
  <br>
  {{--<input type="submit" value="登録する" id="store-data" class="btn btn-info">--}}
  <input type="button" value="登録する" id="store-data" class="btn btn-info">
  <span class="{{ Request::is('tags', 'tags/*') ? 'active' : '' }}">
   <a class="btn btn-danger" href="{{ route('tags.index') }}">タグを追加する</a>
  </span>
 </div>
</div>
{{--</form>--}}