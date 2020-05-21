@extends('layouts.layout')

@section('content')
<div class="signupPage">
 <header class="header">
  <div>アカウントを作成</div>
 </header>
 <div class='container'>

  <form class="form mt-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
   {{ csrf_field() }}

   <label for="file_photo" class="rounded-circle userProfileImg">
    <div class="userProfileImg_description">画像をアップロード</div>
    <i class="fas fa-camera fa-3x"></i>
    <input type="file" id="file_photo" name="img_name">

   </label>
   <div class="userImgPreview" id="userImgPreview">
    <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
    <p class="userImgPreview_text">画像をアップロード済み</p>
   </div>
   <div class="form-group @error('name')has-error @enderror">
    <label>名前</label>
    <input type="text" name="name" class="form-control" placeholder="名前を入力してください">
    @if($errors->has('name'))
    <div class="alert alert-danger">
     @foreach($errors->get('name') as $message)
     <p>{{ $message }}</p>
     @endforeach
    </div>
    @endif
   </div>
   <div class="form-group @error('email')has-error @enderror">
    <label>メールアドレス</label>
    <input type="email" name="email" class="form-control" placeholder="メールアドレスを入力してください">
    @if($errors->has('email'))
    <div class="alert alert-danger">
     @foreach($errors->get('email') as $message)
     <p>{{ $message }}</p>
     @endforeach
    </div>
    @endif

   </div>
   <div class="form-group @error('password')has-error @enderror">
    <label>パスワード</label>
    <em>6文字以上入力してください</em>
    <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
    @if($errors->has('password'))
    <div class="alert alert-danger">
     @foreach($errors->get('password') as $message)
     <p>{{ $message }}</p>
     @endforeach
    </div>
    @endif

   </div>
   <div class="form-group">
    <label>確認用パスワード</label>
    <input type="password" name="password_confirmation" class="form-control" placeholder="パスワードを再度入力してください">
   </div>
   <div class="form-group">
    <div><label>性別</label></div>
    <div class="form-check form-check-inline">
     <input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" checked>
     <label class="form-check-label" for="inlineRadio1">男</label>
    </div>
    <div class="form-check form-check-inline">
     <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2">
     <label class="form-check-label" for="inlineRadio2">女</label>
    </div>
   </div>
   <div class="form-group @error('self_introduction')has-error @enderror">
    <label>自己紹介文</label>
    <textarea class="form-control" name="self_introduction" rows="10"></textarea>
    @if($errors->has('self_introduction'))
    <div class="alert alert-danger">
     @foreach($errors->get('self_introduction') as $message)
     <p>{{ $message }}</p>
     @endforeach
    </div>
    @endif

   </div>
 </div>

 <div class="text-center">
  <button type="submit" class="btn submitBtn">はじめる</button>
  <div class="linkToLogin">
   <a href="{{ route('login') }}">ログインはこちら</a>
  </div>
 </div>
 </form>
</div>
</div>
@endsection