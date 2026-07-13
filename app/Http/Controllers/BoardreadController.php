<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BoardreadRequest;
use App\Models\User;
use App\Models\Board;
use App\Models\Boardimg;
use App\Models\boardread;
use App\Models\boardreadimg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Exception;

class BoardreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('boardread.create')) {
            // ↓エラー画面
            return redirect()->route('boards.error')->with('value', "1");
        }

        try {
            $board = Board::findOrFail($id);
            // ↓掲示板コメント作成画面
            return view("boardread.create", compact("board"));
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("board.error")->with('value', "2");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BoardreadRequest $request)
    {
        // 掲示板コメント作成処理

        $user_id = Auth::user()->id;
        $board_id = $request->input("boardid");
        $user_name = $request->input("username");
        $comment = $request->input("comment");

        $boardread = new Boardread();
        $boardread->user_id = $user_id;

        $boardread->board_id = $board_id;


        $boardread->user_name = $user_name;

        $boardread->comment = $comment;

        $boardread->created_at = Carbon::now('Asia/Tokyo');
        $boardread->updated_at = Carbon::now('Asia/Tokyo');


        // ↓データベースに掲示板を登録できたのかを審議判定しています。
        if ($boardread->save()) {
            
            $imgs = $request->file("img");
            if ($imgs) {
                
                // ↓画像の登録処理
                foreach ($imgs as $img) {
                    
                    // ↓画像があるのかを真偽判定しています。
                    if ($img->isValid()) {

                        
                        $boardreadimg = new Boardreadimg();

                        $boardreadimg->board_id = Board::latest()->value("id");
                        $boardreadimg->boardread_id = Boardread::latest()->value("id");
                        
                        $path = $img->store('image', 'public');
                        $boardreadimg->image_name = 'storage/' . $path;

                        $boardread->created_at = Carbon::now('Asia/Tokyo');
                        $boardread->updated_at = Carbon::now('Asia/Tokyo');

                        $boardreadimg->save();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('boardread.edit')) {
            // ↓エラー画面
            return redirect()->route('boards.error')->with('value', "1");
        }

        try {
            $boardread = Boardread::findOrFail($id);
            $boardreadimg = Boardreadimg::where('boardread_id', $id);
            $board = Board::where('id', $boardread->board_id);
            $user = User::where('id', $boardread->user_id);

            // ↓掲示板コメント編集画面
            return view("boardread.edit", compact("boardread", "boardreadimg", "board", "user"));
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("board.error")->with('value', "2");
        }
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
}
