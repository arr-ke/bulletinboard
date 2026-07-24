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
    Route::resource("boardreads", BoardreadController::class)->except(['create']);

    Route::get('/board/create/{id}', [BoardreadController::class, 'create'])->name('boardreads.create');
});

// ↓ログインインプットのパス
Route::get("userslogininput", [UserController::class, 'logininput'])->name('users.logininput');

// ↓ログインアウトプットのパス
Route::post("usersloginoutput", [UserController::class, 'loginoutput'])->name('users.loginoutput');

// ↓未ログインエラーのパス
Route::get("userserror", [UserController::class, 'error'])->name('users.error');

// ↓未ログイン掲示板検索のパス
Route::post("userssearch", [UserController::class, 'search'])->name('users.search');

// ↓ログイン後エラーのパス
Route::get("boardserror", [BoardController::class, 'error'])->name('boards.error');

// ↓ログアウトのパス
Route::get("boardslogout", [BoardController::class, 'logout'])->name('boards.logout');

// ↓掲示板検索のパス
Route::post("boardssearch", [BoardController::class, 'search'])->name('boards.search');
