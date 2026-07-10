<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BoardRequest;
use App\Models\User;
use App\Models\Board;
use App\Models\Boardimg;
use App\Models\boardread;
use App\Models\boardreadimg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Exception;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BoardRequest $request)
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('board.index')) {
            // ↓エラー画面
            return redirect()->route("boards.error")->with('value', "1");
        }

        try {
            $boards = Board::all();
            // ↓掲示板一覧画面
            return view("board.index", compact("boards"));
        // ↓原因不明エラー起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("boards.error")->with('value', "2");
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('board.create')) {
            // ↓エラー画面
            return redirect()->route('boards.error')->with('value', "1");
        }

        try {
            // ↓掲示板作成画面
            return view("board.create");
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("board.error")->with('value', "2");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BoardRequest $request)
    {
        // 掲示板作成処理

        $user_id = Auth::user()->id;
        $titlename = $request->input("titlename");
        $tema = $request->input("tema");

        $board = new Board();
        $board->user_id = $user_id;
        $board->titlename = $titlename;
        $board->tema = $tema;

        $board->created_at = Carbon::now('Asia/Tokyo');


        // ↓データベースに掲示板を登録できたのかを審議判定しています。
        if ($board->save()) {
            
            $imgs = $request->file("img");
            if ($imgs) {
                
                // ↓画像の登録処理
                foreach ($imgs as $img) {
                    
                    // ↓画像があるのかを真偽判定しています。
                    if ($img->isValid()) {

                        
                        $boardimg = new Boardimg();

                        $boardimg->board_id = Board::latest()->value("id");
                        
                        $path = $img->store('image', 'public');
                        $boardimg->image_name = 'storage/' . $path;

                        $board->created_at = Carbon::now('Asia/Tokyo');

                        $boardimg->save();
                    }
                }
            }

            $boards = Board::all();

            // ↓掲示板一覧画面
            return view("board.index", compact("boards"));
        } else {
            // ↓掲示板作成画面
            return redirect()->route("boards.create")
            ->with('boardcreatemessage', "掲示板の作成に失敗しました")
            ->withInput();
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('board.show')) {
            // ↓エラー画面
            return redirect()->route("boards.error")->with('value', "1");
        }

        try {
            $users = User::all();
            $board = Board::findOrFail($id);
            $boardimgs = Boardimg::where("board_id", $id)->get();
            $boardreads = Boardread::where("board_id", $id)->get();
            $boardreadimgs = Boardreadimg::all();
            
            // ↓掲示板閲覧画面
            return view("board.show", compact("users", "board", "boardimgs", "boardreads", "boardreadimgs"));
        // ↓原因不明エラーが起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("boards.error")->with('value', "2");
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
        // 掲示板削除処理

        $board = Board::findOrFail($id);

        $boardimgs = Boardimg::where("board_id", $board->id)->get();

        // ↓掲示板に保存されている画像があるのかを真偽判定しています。
        foreach ($boardimgs as $boardimg) {

            $deletepath = str_replace('storage', '', $boardimg->image_name);
            Storage::disk('public')->delete($deletepath);
        
            $boardimg->delete();
        }

        // ↓掲示板が削除できているのかを真偽判定しています。
        if ($board->delete()) {
            $boards = Board::all();

            // ↓掲示板一覧画面
            return view("board.index", compact("boards"));
        } else {
            $users = User::all();
            $board = Board::findOrFail($id);
            $boardimgs = Boardimg::where("board_id", $id)->get();
            $boardreads = Boardread::where("board_id", $id)->get();
            $boardreadimgs = Boardreadimg::where("board_id", $id)->get();

            $boarddeletemessage = "掲示板の削除に失敗しました。";

            // ↓掲示板閲覧画面
            return view("board.show", compact("users", "board", "boardimgs", "boardreads", "boardreadimgs", "boarddeletemessage"));
        }

    }

    public function error(BoardRequest $request) {
        // ↓エラー画面
        return view("board.error"); 
    }

    public function logout(BoardRequest $request) {

        try {
            // ログアウト処理

            // ↓今のセッションをログアウト
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            if (!Auth::check() || !view()->exists('board.logout')) {
                // ↓ログイン画面
                return redirect()->route("users.logininput");
            } else {
                // ↓エラー画面
                return redirect()->route("boards.error")->with('value', "1");
            }
            
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("boards.error")->with('value', "2");
        }
        
    }
}
