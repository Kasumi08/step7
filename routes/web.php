<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login'); // 未ログインの場合、ログイン画面へリダイレクト
}); 

Auth::routes();

// 商品一覧画面をログイン後のみ表示
Route::group(['middleware' => 'auth'], function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::resource('products', ProductController::class)->except(['index']);
});

// ログイン後のリダイレクト先を /products に変更
Route::get('/home', function () {
    return redirect('/products');
});

Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');


