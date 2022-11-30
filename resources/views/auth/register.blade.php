@extends('layouts.logout')

@section('content')

@if($errors->any())
<div>
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<section>

  <div class="form-b">
    {!! Form::open() !!}
    <p class="welcome">新規ユーザー登録</p>
    <div class="form-content">
      {{ Form::label('username') }}
      {{ Form::text('username',null,['class' => 'input form-control']) }}
    </div>
    <div class="form-content">
      {{ Form::label('e-mail') }}
      {{ Form::text('mail',null,['class' => 'input form-control']) }}
    </div>
    <div class="form-content">
      {{ Form::label('password') }}
      {{ Form::text('password',null,['class' => 'input form-control']) }}
    </div>
    <div class="form-content">
      {{ Form::label('password-confirm') }}
      {{ Form::text('password_confirmation',null,['class' => 'input form-control']) }}
    </div>
    <div class="btn-form">
      {{ Form::submit(' REGISTER ', ['class'=>'btn btn-danger']) }}
    </div>
    <p class="text"><a href="/login" class="link">ログイン画面へ戻る</a></p>
    {!! Form::close() !!}
  </div>

</section>


@endsection
