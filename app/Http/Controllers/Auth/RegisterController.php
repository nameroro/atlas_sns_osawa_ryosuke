<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|min:2|max:12',
            'mail' => 'required|string|email|min:5|max:40|unique:users',
            'password' => 'required|string|min:8|max:20|confirmed',
        ], [
            'username.required' => 'ユーザー名を入力して下さい',
            'username.min' => 'ユーザー名は2文字以上、12文字以内で入力して下さい',
            'username.max' => 'ユーザー名は2文字以上、12文字以内で入力して下さい',
            'mail.required' => 'メールアドレスを入力して下さい',
            'mail.email' => '適切なメールアドレスを入力して下さい',
            'mail.min' => 'メールアドレスは5文字以上、40文字以内で入力して下さい',
            'mail.max' => 'メールアドレスは5文字以上、40文字以内で入力して下さい',
            'mail.unique' => 'このメールアドレスは既に使用されています',
            'password.required' => 'パスワードを入力して下さい',
            'password.alpha_num' => 'パスワードは英数字のみで入力して下さい',
            'password.min' => 'パスワードは8文字以上、20文字以内で入力して下さい',
            'password.max' => 'パスワードは8文字以上、20文字以内で入力して下さい',
            'password.confirmed' => 'パスワードが一致していません',
            'password_confirmation.required' => '確認パスワードを入力して下さい',
            'password_confirmation.alpha_num' => 'パスワードは英数字のみで入力して下さい',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
            'images' => 'icon1.png',
        ]);
    }


    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();

            $validator = $this->validator($data);
            if($validator->fails()){
            return redirect('register')
            ->withErrors($validator)
            ->withInput();
            }

            $this->create($data);
            // dd($data);
            return redirect('added');
        }
        return view('auth.register');
    }

    public function added(){
        $userData = User::latest('id')->first();
        // dd($userData);
        return view('auth.added', ['userData' => $userData]);
    }

    public function redirectPath()
    {
        return 'top';
    }

}
