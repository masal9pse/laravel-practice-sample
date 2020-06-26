<form action="{{ route('admin.store')}}" method="post" enctype="multipart/form-data">
 {{ csrf_field() }}
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
    <input type="text" name="title" class="form-control" placeholder="タイトル">
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
    <textarea name="detail" class="form-control" placeholder="歌詞を入力してください"></textarea>
   </div>
   <br>
   <br>
   <br>
   {{-- <div class="col-sm-10"> --}}
   {{-- @if($errors->has('file_name'))
   @foreach($errors->get('file_name') as $message)
   <div class="text-danger">
    {{ $message }}
  </div>
  @endforeach
  @endif --}}
  <input type="file" class="form-control" name="file_name">
  {{-- </div> --}}
  <br>
  <div>
   {{-- <label for="inputTag" class="col-sm-2 col-form-label">タグをつける</label> --}}
   <div class="form-check form-check-inline">
    @foreach($tags as $key => $tag)
    <input type="checkbox" name="tags[]" value="{{ $key }}" id="tag{{ $key }}" @if(isset($song->tags) &&
    $song->tags->contains($key))
    checked
    @endif
    >
    <label for="tag{{ $key }}" class="form-check-label">{{ $tag }}</label>
    @endforeach
   </div>
  </div>
  <br>
  {{-- <div class="col-md-10"> --}}
  <input type="submit" value="登録する" class="btn btn-info">
  {{-- </div> --}}
 </div>
 </div>
</form>