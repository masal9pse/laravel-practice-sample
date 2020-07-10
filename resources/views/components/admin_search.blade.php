{{ Form::open(['method' => 'get'],['route' => 'admin.create'],['class' => "form-inline my-2 my-lg-0"]) }}
<input class="form-control mr-sm-2" name="search" type="search" placeholder="タイトルを入力してください" aria-label="Search">
<br>
<button class="btn btn-success my-2 my-sm-0" type="submit">検索する</button>
<a href="{{ route('songs.index')}}" class="btn btn-primary">トップページに移動</a>
{{Form::close()}}