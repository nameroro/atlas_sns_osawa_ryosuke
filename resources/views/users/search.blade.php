@extends('layouts.login')

@section('content')

<div class="srh-container">
  <div class="srh-box">
    <form method = "POST" action = "{{ url('/usersearch')}}">
      @csrf
      <input type = "text" palaceholder = "ユーザー名" name = "keyword" class="srh-area" placeholder="ユーザー名">
      <input type = "image" name = "" src = "/images/search.png" alt = "検索" width="40" class="icon-srh">
      <!-- <button type = "submit">検索</button> -->
    </form>
  </div>

  <div class="keyword">
    @if(!empty($keyword)) <!--空欄の時にエラーが起きないように追記-->
    <p>検索ワード：{{ $keyword }}</p>
    @endif
  </div>

</div>

<div class="srh-result">
  @foreach($users as $user)
  <div class="srh-list">
    <div class="srh-user">
      <p><img src="{{ asset('storage/' .$user->images)}}" alt="アイコン" class="icon"></p>
      <p>{{$user->username}}</p>
    </div>
    <div class="btn-ff">
      @if(Auth::user()->isFollowing($user->id))
        <form method = "POST" action = "{{ route('unfollow', ['user' => $user->id]) }}">
         @csrf
          <button type = "submit" class="btn btn-outline-danger">ー フォロー解除</button>
       </form>
      @else
       <form method = "POST" action = "{{ route('follow', ['user' => $user->id]) }}">
          @csrf
          <button type = "submit" class="btn btn-outline-info">＋ フォローする</button>
        </form>
      @endif
    </div>
</div>
  @endforeach
</div>


@endsection
