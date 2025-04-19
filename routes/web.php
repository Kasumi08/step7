<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

// 認証関連ルート
Auth::routes();

// トップページ → 直接商品一覧へリダイレクト（ログインしてなければ middleware が login に飛ばす）
Route::get('/', function () {
    return redirect()->route('products.index');
});

// ログイン後のルートグループ
Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});
