<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Board;
use App\Models\Boardimg;
use App\Models\boardread;
use App\Models\boardreadimg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.index')) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "1");
        }

        try {
            $boards = Board::all();
            return view("user.index", compact("boards"));
        // ↓原因不明エラー起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "2");
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.show')) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "1");
        }

        try {

            $users = User::all();
            $board = Board::findOrFail($id);
            $boardimgs = Boardimg::where("board_id", $id)->get();
            $boardreads = Boardread::where("board_id", $id)->get();
            $boardreadimgs = Boardreadimg::where("board_id", $id)->get();
            
            return view("user.show", compact("users", "board", "boardimgs", "boardreads", "boardreadimgs"));
        // ↓原因不明エラーが起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "2");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(UserRequest $request) {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.login')) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "1");
        }


        try {
            // ↓IDとPWに値が入力されているのかを真偽判定しています。
            if ($request->filled('id') && $request->filled('pw')) {
                // ↓ログイン処理
                $login = [
                    'name' => $request->input('id'),
                    'pw' => $request->input('pw'),
                ];

                // ↓ログインしているのかを真偽判定しています。
                if (Auth::attempt($login)) {
                    // ↓掲示板一覧画面
                    return redirect()->route('board.index');
                }
                // ↓ログイン画面
                return redirect()->route('user.login')->with('loginmessage', "ログインに失敗しました。");
            } else {
                // ↓ログイン画面
                return view("user.login");
            }
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "2");
        }
    }

    public function error(UserRequest $request) {
        // ↓エラー画面
        return view("user.error"); 
    }
}
