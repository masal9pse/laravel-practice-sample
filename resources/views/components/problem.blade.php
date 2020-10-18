<form action="{{ route('problems.store')}}" method="post" class="col-3">
 {{ csrf_field() }}
 <h3 class="text-danger">問題や感想があれば報告お願いします</h3>
 <div class="form-group">
  @if($errors->has('name'))
  @foreach($errors->get('name') as $message)
  <div class="text-danger">
   {{ $message }}
  </div>
  @endforeach
  @endif
  <label for="exampleInputName2">名前</label>
  <input type="text" name="name" class="form-control" id="exampleInputName2" placeholder="名前">
 </div>
 <div class="form-group">
  @if($errors->has('problem'))
  @foreach($errors->get('problem') as $message)
  <div class="text-danger">
   {{ $message }}
  </div>
  @endforeach
  @endif
  <textarea name="problem" class="form-control mb-5" rows="3" placeholder="問題、意見お願いします"></textarea>
 </div>
 <div class="form-group">
  <button type="submit" class="btn btn-warning">投稿</button>
 </div>
</form>
{{--@foreach ($problems as $problem)
<div class="form-group">
 <span>名前: {{ $problem->name }}</span>
<div class="form-group">感想: {{ $problem->problem }}</div>
</div>
@endforeach--}}