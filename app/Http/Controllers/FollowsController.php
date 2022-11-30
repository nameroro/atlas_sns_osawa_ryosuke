<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Follow;

use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{

    //フォローリスト
    public function followList(){
        $others_icon = Follow::join('users', 'follows.followed_id', '=', 'users.id')
        ->where('following_id', Auth::User()->id)
        ->get(); //iconからプロフィールに飛ぶために記述
        // dd($others_icon);

        $follows = Follow::join('users', 'follows.followed_id', '=', 'users.id')//テーブル結合
        ->leftjoin('posts', 'users.id', '=', 'posts.user_id')//テーブル結合
        ->select('follows.*', 'users.id as others_id', 'users.username', 'users.images', 'posts.user_id', 'posts.post', 'posts.created_at', 'posts.updated_at')
        ->where('following_id', Auth::User()->id)//ログインユーザーがフォローしてる人の取得
        ->orderBy('posts.created_at', 'desc')//降順で取得
        ->get();
        // dd($follows);

        return view('follows.followList', compact('follows', 'others_icon'));
        // return view(['follows' => $follows , 'others_icon' => $others_icon]);
    }


    //フォロワーリスト
    public function followerList(){
        $others_icon = Follow::join('users', 'follows.following_id', '=', 'users.id')
        ->where('followed_id', Auth::User()->id)
        ->get(); //iconからプロフィールに飛ぶために記述
        // dd($others_icon);

        $followers = Follow::join('users', 'follows.following_id', '=', 'users.id')
        ->leftjoin('posts', 'users.id', '=', 'posts.user_id')
        ->select('follows.*', 'users.id as others_id', 'users.username', 'users.images', 'posts.user_id', 'posts.post', 'posts.created_at', 'posts.updated_at')
        ->where('followed_id', Auth::User()->id)
        ->orderBy('posts.created_at', 'desc')
        ->get();
        // dd($followers);
        return view('follows.followerList', compact('followers', 'others_icon'));
    }



}
