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
    Route::resource("Boards", BoardController::class);

    // ↓掲示板のパス
    Route::resource("Boardreads", BoardreadController::class);
});

// ↓ログインインプットのパス
Route::get("userslogininput", [UserController::class, 'logininput'])->name('users.logininput');

// ↓ログインアウトプットのパス
Route::post("usersloginoutput", [UserController::class, 'loginoutput'])->name('users.loginoutput');

Route::get("userserror", [UserController::class, 'error'])->name('user.error');
