<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; //User::query()を使うために記載
use App\Post;

use Illuminate\Support\Facades\Validator; //Validator::make()を使うために記載

use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Encryption\DecryptException;

class UsersController extends Controller
{



    //ユーザー表示
    public function search(){
        //usersテーブルの内容を全て取得
        $users = \DB::table('users')->get();
        return view('users.search',['users' => $users]);
    }

    //ユーザー検索
    public function usersearch(Request $request){
        $keyword = $request->input('keyword');
        $query = User::query();
        if(!empty($keyword)){
            $query->where('username', 'LIKE', "%{$keyword}%");
        }
        // ddd($keyword); 検索ワードは問題なし
        $users = $query->get();
        // ddd($users);
         // return redirect('/search'); これだとエラーは起きない
            return view('users.search',['users' => $users, 'keyword' => $keyword]);
            // return redirect('/search', compact('users','keyword'));
    }

    //フォロー機能
    public function follow(User $user){
       $follower = Auth::user();
       // フォローしているか
       $is_following = $follower->isFollowing($user->id);
       if(!$is_following) {
           // フォローしていなければフォローする
           $follower->follow($user->id);
           return back();
       }
   }

   // フォロー解除機能
   public function unfollow(User $user){
       $follower = Auth::user();
       // フォローしているか
       $is_following = $follower->isFollowing($user->id);
       if($is_following) {
           // フォローしていればフォローを解除する
           $follower->unfollow($user->id);
           return back();
       }
   }

   //他ユーザーのプロフィールページ
   public function othersProfile($id){
        $others = User::find($id);
        // dd($others);
        $othersPost = User::join('posts', 'users.id', '=','posts.user_id')
        ->where('user_id', '=', $id)
        ->orderBy('posts.created_at', 'desc')//降順で取得
        ->get();
        // dd($othersPost);
        return view('users.othersProfile', ['others' => $others, 'othersPost' => $othersPost]);
   }

   //ログインユーザーのプロフィールページ表示
   public function profile(){
       $user = Auth::user();
    //    dd($user);
       return view('users.profile', ['user' => $user, ]);
   }

    // ログインユーザーのプロフィールページ編集
    public function update(Request $request){
        //↓バリデーション↓
        $validate = [
            'username' => 'required|min:2|max:12',
            'mail' => 'required|min:5|max:40|unique:users,mail|email',
            'password' => 'required|alpha_num|min:8|max:20|confirmed',
            'password_confirmation' => 'required|alpha_num|min:8|max:20',
            'bio' => 'max:150',
            'images' => 'required|alpha_dash|image'
        ];
        $massage = [
            'username.required' => 'ユーザー名を入力して下さい',
            'username.min' => 'ユーザー名は2文字以上、12文字以内で入力して下さい',
            'username.max' => 'ユーザー名は2文字以上、12文字以内で入力して下さい',
            'mail.required' => 'メールアドレスを入力して下さい',
            'mail.min' => 'メールアドレスは5文字以上、40文字以内で入力して下さい',
            'mail.max' => 'メールアドレスは5文字以上、40文字以内で入力して下さい',
            'mail.unique' => 'このメールアドレスは既に使用されています',
            'mail.email' => '適切なメールアドレスを入力して下さい',
            'password.required' => 'パスワードを入力して下さい',
            'password.alpha_num' => 'パスワードは英数字のみで入力して下さい',
            'password.min' => 'パスワードは8文字以上、20文字以内で入力して下さい',
            'password.max' => 'パスワードは8文字以上、20文字以内で入力して下さい',
            'password.confirmed' => 'パスワードが一致していません',
            'password_confirmation.required' => '確認パスワードを入力して下さい',
            'password_confirmation.alpha_num' => 'パスワードは英数字のみで入力して下さい',
            'bio.max' => 'さすがにそれは長過ぎる。。。',
            'images.required' => 'アイコンを設定して下さい',
            'images.alpha_dash' => 'ファイル名は英数字のみです',
            'images.image' => '選択されたファイルは画像ではありません',
        ];
        $validator = Validator::make($request->all(), $validate, $massage);
        if($validator->fails()){
            return redirect('profile')
            ->withErrors($validator)
            ->withInput();
        }
        //↑バリデーション↑
        $id = $request->input('id');
        $username = $request->input('username');
        $mail = $request->input('mail');
        $password = bcrypt($request->input('password'));
        $bio = $request->input('bio');
        $images = $request->file('images')->store('icon', 'public'); //publicの中にiconディレクトリを作成し、そこにパスを通す
        // dd($request->file('images'));
        \DB::table('users')
        ->where('id', $id)
        ->update(['username' => $username, 'mail' => $mail, 'password' => $password, 'bio' => $bio, 'images' => $images]);
        // dd($id, $username, $mail, $password, $bio, $images);
        return redirect('/top');

    }


}
