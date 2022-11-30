<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログアウト中に下記urlに飛ぼうとしたら/loginに飛ぶルーティングをグループ化
Route::group(['middleware' => 'auth'], function () {

    //ログイン中のページ
    Route::get('/top','PostsController@index');


    Route::get('/search','UsersController@search');

    //ログアウト
    Route::get('/logout','Auth\LoginController@logout');

    //フォロー一覧
    Route::get('/follow-list','FollowsController@followList');
    //フォロワー一覧
    Route::get('/follower-list','FollowsController@followerList');

    //フォロー機能
    Route::post('/users/{user}/follow', 'UsersController@follow')->name('follow');
    // Route::post('/follow', 'UsersController@follow')->name('follow');
    //フォロー解除機能
    Route::post('/users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

    //投稿フォーム　いらなかった
    //Route::get('post/create-form', 'PostsController@createForm');
    //投稿
    Route::post('/create', 'PostsController@create');

    //投稿編集
    Route::post('/update', 'PostsController@update');

    //削除機能
    Route::get('post/{id}/delete', 'PostsController@delete');

    //ユーザー検索
    Route::post('/usersearch', 'UsersController@usersearch');

    //他ユーザーのプロフィール
    Route::get('/others-profile/{id}', 'UsersController@othersProfile');

    //ログインユーザーのプロフィール表示
    Route::get('/profile','UsersController@profile');
    //ログインユーザーのプロフィール更新
    Route::post('/update','UsersController@update')->name('profile-update');

});
