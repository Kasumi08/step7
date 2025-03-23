<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * 新規登録後にログイン画面へリダイレクト
     *
     * @var string
     */
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * 新規登録時のバリデーションルール
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * 新規ユーザーを作成
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => 'No Name', // デフォルト値を設定
        ]);
    }

    /**
     * 新規登録後にログアウトし、ログイン画面へリダイレクト
     */
    protected function registered(Request $request, $user)
    {
        Auth::logout(); // ログアウト処理
        return redirect('/login')->with('status', '登録が完了しました。ログインしてください。');
    }
}
