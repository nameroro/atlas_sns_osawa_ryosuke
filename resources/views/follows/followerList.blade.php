@extends('layouts.login')

@section('content')

<div class="ff-container">
  <h2>Follower List</h2>
  <div class="ff-icon">
    @foreach($others_icon as $icon)
    <ul>
      <li><a href = "/others-profile/{{ $icon->id }}"><img src = "{{ asset('storage/' .$icon->images) }}" alt = "アイコン" class="icon"></a></li>
      @csrf
    </ul>
    @endforeach
  </div>
</div>

<!-- ->unique('user_id')  -->

<div class="timeline">
  @foreach($followers as $follow)
  @if(!empty($follow->id) && !empty($follow->post))
  <div class="post">
    <p><img src = "{{ asset('storage/' .$follow->images) }}" alt = "アイコン" class="icon"></p>
    <div class="post-content">
      <p class="post-username">{{ $follow->username }}</p>
      <p class="post-text">{{ $follow->post }}</p>
      <p class="post-time">{{ $follow->created_at }}</p>
    </div>
  </div>
  @endif
  @endforeach
</div>

@endsection
