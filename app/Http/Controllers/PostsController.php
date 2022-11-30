<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\User;

use Illuminate\Support\Facades\Validator; //Validator::make()を使うために記載


//Auth::id()を用いてユーザーIDを取得
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    //
    public function index(){
        // $posts = \DB::table('posts')
        // $posts = Post::join('users', 'posts.user_id', '=', 'users.id')
        // ->get(); //この記述だと$postの中身がusersテーブルのidになる

        // $posts = Post::get(); //この記述のみで全ユーザーの投稿を表示

        $posts = Post::query()
        ->whereIn('user_id', Auth::user()->following()->pluck('followed_id'))
        ->orWhere('user_id', Auth::user()->id)
        ->latest() //最新順に取得
        ->get();

        //下記記述でも可(Atlas参照)
        // フォローしているユーザーのidを取得
        // $following_id = Auth::user()->following()->pluck('followed_id');
        // フォローしているユーザーのidを元に投稿内容を取得
        // $posts = Post::with('user')->whereIn('user_id', $following_id)
        // ->get();

        // dd($posts);
        //取得した内容を$postsでbladeに渡す
        return view('posts.index',['posts' => $posts]);
    }

    //投稿機能設置
    public function create(Request $request){
        //↓バリデーション↓
        $validate = [
            'post' => 'required|min:1|max:200'
        ];
        $massage = [
            'post.required' => '投稿内容が入力されていません',
            'post.min' => '投稿は2文字以上、12文字以内で入力して下さい',
            'post.max' => '投稿は2文字以上、12文字以内で入力して下さい',
        ];
        $validator = Validator::make($request->all(), $validate, $massage);
        if($validator->fails()){
            return redirect('top')
            ->withErrors($validator)
            ->withInput();
        }
        //↑バリデーション↑

        $id = Auth::id();
        //idの中身が取得できているか確認
        // ddd($id);

        $post = $request->input('newPost');
        \DB::table('posts')->insert([
            'post' => $post,
            'user_id' => $id
        ]);

        return redirect('/top');
    }

    //投稿編集機能設置
    public function update(Request $request){
        $id = $request->input('id');
        $up_post = $request->input('up_post');
        \DB::table('posts')
        ->where('id', $id)
        ->update(['post' => $up_post]);
        // dd($up_post, $id);
        return redirect('/top');
    }

    //投稿削除機能
        public function delete($id){
        \DB::table('posts')
        ->where('id', $id)
        ->delete();
        // dd($id);
        return redirect('/top');
    }


}
