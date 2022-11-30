<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password', 'images'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // postsテーブルとのリレーション（主テーブル側）
    public function posts(){ //1対多の「多」側なので複数形
        return $this->hasMany('App\Post');
    }

    public function getData(){
        return $this->username .$this->images;
    }

    //ユーザーがフォローしている人の取得
    public function following(){
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
    }

    //ユーザーをフォローしている人の取得
    public function followed(){
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
    }


     // フォローする
   public function follow($user_id){
       return $this->following()->attach($user_id);
   }

   // フォロー解除する
   public function unfollow($user_id){
       return $this->following()->detach($user_id);
   }

   // フォローしているか
   public function isFollowing($user_id){
       return (boolean) $this->following()->where('followed_id', $user_id)->first();
   }

   // フォローされているか
   public function isFollowed($user_id){
       return (boolean) $this->followed()->where('following_id', $user_id)->first();
   }


}


// ->first(['id']);
