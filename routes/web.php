<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BoardreadController;

Route::get('/', function () {
    return view('welcome');
});

// ↓ユーザーのパス
Route::resource("users", UserController::class);

Route::middleware('auth')->group(function () {
    // ↓掲示板のパス
    Route::resource("boards", BoardController::class);

    // ↓掲示板のパス
    Route::resource("boardreads", BoardreadController::class);
});

// ↓ログインインプットのパス
Route::get("userslogininput", [UserController::class, 'logininput'])->name('users.logininput');

// ↓ログインアウトプットのパス
Route::post("usersloginoutput", [UserController::class, 'loginoutput'])->name('users.loginoutput');

// ↓未ログインエラーのパス
Route::get("userserror", [UserController::class, 'error'])->name('users.error');

// ↓ログイン後エラーのパス
Route::get("boardserror", [BoardController::class, 'error'])->name('boards.error');

// ↓ログアウトのパス
Route::get("boardslogout", [BoardController::class, 'logout'])->name('boards.logout');