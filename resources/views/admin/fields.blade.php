@if($errors->any())
<div class="alert alert-danger">
 @foreach($errors->all() as $message)
 <p>{{ $message }}</p>
 @endforeach
</div>
@endif
<label for="inputTag" class="col-sm-2 col-form-label">タグ</label>
<div class="form-group row">
 <div class="col-sm-10">
  @foreach($tags as $key => $tag)
  <div class="form-check form-check-inline">
   <input type="checkbox" name="tags[]" value="{{ $key }}" id="tag{{ $key }}" @if(isset($song->tags) &&
   $song->tags->contains($key))
   checked
   @endif
   >
   <label for="tag{{ $key }}" class="form-check-label">{{ $tag }}</label>
  </div>
  @endforeach
  {{-- @error('tags')
      <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
  </span>
  @enderror --}}
 </div>
</div>