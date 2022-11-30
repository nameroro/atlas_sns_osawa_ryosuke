@extends('layouts.logout')

@section('content')

<section>

  <div class="form-a">
    {!! Form::open() !!}
    <p class="welcome">AtlasSNSへようこそ</p>
    <div class="form-content">
      {{ Form::label('e-mail') }}
      {{ Form::text('mail',null,['class' => 'input form-control']) }}
    </div>
    <div class="form-content">
      {{ Form::label('password') }}
      {{ Form::password('password',['class' => 'input form-control']) }}
    </div>
    <div class="btn-form">
      {{ Form::submit(' LOGIN ', ['class'=>'btn btn-danger']) }}
    </div>
    <p class="text"><a href="/register" class="link">新規ユーザーの方はこちら</a></p>
    {!! Form::close() !!}
  </div>

</section>

@endsection
