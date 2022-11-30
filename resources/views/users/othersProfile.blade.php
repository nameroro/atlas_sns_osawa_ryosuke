@extends('layouts.login')

@section('content')

<div class="others-container">
    <img src="{{ asset('storage/' .$others->images) }}" alt="アイコン" class="icon">
    <table>
      <tr>
        <th>name</th>
        <td>{{ $others->username }}</td>
      </tr>
      <tr>
        <th>bio</th>
        <td>{{ $others->bio }}</td>
      </tr>
    </table>

  <div class="btn-ff">
    @if(Auth::user()->isFollowing($others->id))
      <form method = 'POST' action = "{{ route('unfollow', ['user' => $others->id]) }}">
      @csrf
        <button type = "submit"class="btn btn-outline-danger">ー フォロー解除</button>
    </form>
    @else
    <form method = 'POST' action = "{{ route('follow', ['user' => $others->id]) }}">
        @csrf
        <button type = "submit" class="btn btn-outline-info">＋ フォローする</button>
      </form>
    @endif
  </div>
</div>



<div class="timeline">
  @foreach($othersPost as $othersPosts)
  <div class="post">
    <p><img src="{{ asset('storage/' .$othersPosts->images)}}" alt="アイコン" class="icon"></p>
    <div class="post-content">
      <p class="post-username">{{$othersPosts->username}}</p>
      <p class="post-text">{{$othersPosts->post}}</p>
      <p class="post-time">{{$othersPosts->created_at}}</p>
    </div>
</div>
  @endforeach
</div>

@endsection
