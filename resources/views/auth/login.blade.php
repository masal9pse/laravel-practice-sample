@extends('layouts.layout')

@section('content')
<div class='signinPage'>
 <div class='container'>
  <div class='userIcon'>
   <i class="fas fa-user fa-3x"></i>
  </div>
  <h2 class="title">ログイン</h2>
  <form class="form" method="POST" action="{{ route('login') }}">
   {{ csrf_field() }}
   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label>メールアドレス</label>
    <input type="email" name="email" class="form-control" placeholder="メールアドレスを入力してください" autofocus>
    @if ($errors->has('email'))
    <span class="help-block">
     <strong>{{ $errors->first('email') }}</strong>
    </span>
    @endif
   </div>

   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label>パスワード</label>
    <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
    @if ($errors->has('password'))
    <span class="help-block">
     <strong>{{ $errors->first('password') }}</strong>
    </span>
    @endif
   </div>

   <div class="form-group text-center">
    <button type="submit" class="loginBtn">ログイン</button>
   </div>
   <div class="linkToLogin">
    <a href="{{ route('register') }}">アカウント作成はこちら</a>
   </div>
  </form>
 </div>
</div>
@endsection