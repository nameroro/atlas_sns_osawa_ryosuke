@extends('layouts.login')

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


<div class="prf-container">
  <div class="prf-icon">
    <img src = "{{ asset('storage/' .$user->images) }}" alt = "アイコン" class="icon">
  </div>
  <div class="profile">
    <form method = "POST" action = "{{ route('profile-update') }}" enctype = "multipart/form-data">
      <input type="hidden" name = "id" value = "{{ Auth::user()->id }}">
      @csrf
      <div class="form-prf">
        <label>
          user name<input type = "text" name = "username" value = "{{ $user->username }}" class="input form-control">
        </label>
        <label>
          mail adress<input type = "text" name = "mail" value = "{{ $user->mail }}" class="input form-control">
        </label>
        <label>
          password<input type = "password" name = "password" value = "" class="input form-control">
        </label>
        <label>
          password comfirm<input type = "password" name = "password_confirmation" value = "" class="input form-control">
        </label>
        <label>
          bio<input type = "text" name = "bio" value = "{{ $user->bio }}" class="input form-control">
        </label>
        <label>
          icon image<input type = "file" name = "images" value = "ファイルを選択"  class="input form-control">
        </label>
      </div>
      <button type = "submit" class="btn btn-danger">更新</button>
    </form>
  </div>
</div>


@endsection
