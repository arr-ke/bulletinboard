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


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ↓設定ファイルがない、DBが空などが原因のリンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.index')) {
            // ↓エラー画面
            return redirect()->route('user.error')->with('value', "1");
        }

        try {
            $boards = Board::all();
            return view("user.index", compact("boards"));
        } catch (Exception $e) {
            return redirect()->route('user.error')->with('value', "3");
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
        $users = User::all();
        $board = Board::findOrFail($id);
        $boardimgs = Boardimg::where("board_id", $id)->get();
        $boardreads = Boardread::where("board_id", $id)->get();
        $boardreadimgs = Boardreadimg::where("board_id", $id)->get();
        
        return view("user.show", compact("users", "board", "boardimgs", "boardreads", "boardreadimgs"));
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

    public function login() {

    }

    public function error(UserRequest $request) {
        // ↓エラー画面
        return view("user.error"); 
    }
}
