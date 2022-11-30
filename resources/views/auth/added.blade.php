@extends('layouts.logout')

@section('content')

<div id="clear" class="form-c">
  <div>
    <p>{{ $userData->username }}さん</p>
    <p>ようこそ！AtlasSNSへ！</p>
  </div>
  <br>
  <div>
    <p>ユーザー登録が完了しました。</p>
    <p>早速ログインをしてみましょう。</p>
  </div>
  <div class="btn-login">
    <p class="btn btn-danger"><a href="/login" class="link">ログイン画面へ</a></p>
  </div>
</div>

@endsection
