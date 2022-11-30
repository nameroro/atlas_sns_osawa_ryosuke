@extends('layouts.login')

@section('content')
<!-- <h2>機能を実装していきましょう。</h2> -->


@if($errors->any())
<div>
  <ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="post-container">
  <form action = "{{ url('/create') }}" method = "POST" class="was-validated">
    @csrf <!--formタグ使用時は@csrf記述しないと419page not foundになる-->
    <img src="{{ asset('storage/' .Auth::user()->images)}}" alt="アイコン" class="icon postman">
    <textarea  name = "newPost" placeholder = "投稿内容を入力して下さい" size="10" maxLength="150" class="textarea "></textarea>
    <!-- <input type = "text" name = "newPost" placeholder = "投稿内容を入力して下さい" size="10" maxLength="150" class="textline"> -->
    <div class="img-post">
      <input type = "image" name = "" src = "/images/post.png" alt = "投稿" width="75px">
    </div>
    <!-- <input type = "image" name = "" src = "/images/post.png" alt = "投稿" width="60px"> -->
  </form>
</div>

<!-- PostsControllerから渡された$postsを画面に表示 -->
    <div class="timeline">
    @foreach($posts as $list)
      <div class="post">
        <p><img src="{{ asset('storage/' .$list->user->images) }}" alt="アイコン" class="icon"></p>
        <div class="post-content">
          <p class="post-username">{{ $list->user->username }}</p>
          <p class="post-text">{{ $list->post }}</p>
        </div>
        <p class="post-time">{{ $list->created_at }}</p>
          @if($list->user->id == Auth::id())
            <div class="post-img">
              <p class="post-edit"><a class = "js-modal-open" href = "/post/{{ $list->id }}/update-form" post = "{{ $list->post }}" post_id = "{{ $list->id }}"><img src = "/images/edit.png" alt = "編集" class="img"></a></p>
              <p class="post-edit"><a class = "" href = "/post/{{$list->id}}/delete" onclick = "return confirm('この投稿を削除します。よろしいでしょうか？')"><img src = "/images/trash.png" alt = "削除"  class="img"></a></p>
            </div>
          @endif
      </div>

    @endforeach
    </div>


     <!-- モーダルの中身 -->
      <div class = "modal js-modal">
         <div class = "modal__bg js-modal-close"></div>
         <div class = "modal__content">
             <form action = "{{ url('/update') }}" method = "POST">
                  <textarea name = "up_post" class = "modal_post"></textarea>
                  <input type = "hidden" name = "id" class = "modal_id" value = "">
                  <input type = "submit" value = "更新">
                  {{ csrf_field() }}
             </form>
             <a class = "js-modal-close" href = "">閉じる</a>
         </div>
     </div>




@endsection


<!-- , $id->user_id -->
