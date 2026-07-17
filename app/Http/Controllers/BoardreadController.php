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

            // ↓画像があるのかを真偽判定しています。
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
            ->with('boardreadupdatemessage', "掲示板コメント作成に失敗しました")
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
            $boardreadimgs = Boardreadimg::where('boardread_id', $id)->get();

            $board = Board::where('id', $boardread->board_id)->get();
            $user = User::where('id', $boardread->user_id)->get();

            // ↓掲示板コメント編集画面
            return view("boardread.edit", compact("boardread", "boardreadimgs", "board", "user"));
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
        // 掲示板コメント編集処理

        $user_id = Auth::user()->id;
        $board_id = $request->input("boardid");
        $boardread_id = $request->input("boardreadid");
        $user_name = $request->input("username");
        $comment = $request->input("comment");

        $boardread = Boardread::findOrFail($id);

        $boardread->user_id = $user_id;
        $boardread->board_id = $board_id;
        $boardread->user_name = $user_name;
        $boardread->comment = $comment;

        $boardread->updated_at = Carbon::now('Asia/Tokyo');

        $boardread->save();

        //画像削除処理
        $imgselects = $request->input('imgselect', []);
 

        // 掲示板画像を呼び出しています。
        $boardreadimgs = Boardreadimg::where('board_id', $board_id)
                                    ->where('boardread_id', $boardread_id)
                                    ->get();

        // ↓これはすでに登録されている画像が削除されているかの値です。
        $value = false;

        foreach ($boardreadimgs as $boardreadimg) {

            // 画像が削除が選択されているのかを真偽判定しています。
            if (isset($imgselects[$boardreadimg->id]) && $imgselects[$boardreadimg->id] == 1) {
                $deletepath = str_replace('storage', '', $boardreadimg->image_name);
                Storage::disk('public')->delete($deletepath);
            
                $boardreadimg->delete();
                
                
            }
        }


        // 画像登録処理
        $imgs = $request->file("img");

        // 掲示板コメント画像のカウント処理
        $count = 0;
        
        if ($imgs) {
            // ↓これから登録する画像をカウントしています。
            foreach ($imgs as $img) {
                $count++;
            }
        }

        // ↓すでに登録されている画像をカウントしています。
        foreach ($boardreadimgs as $boardreadimg) {
            $count++;
        }


        // ↓countが10なのかを真偽判定しています。
        if ($count >= 11) {
            // ↓掲示板コメント編集画面
            return redirect()->route("boardreads.edit", $boardread_id)
            ->with('boardupdeleeerrormessage', "掲示板コメント画像が10枚以上あります。\n画像の追加登録は一度画像削除してください。")
            ->withInput();
        }

        // ↓画像があるのかを真偽判定しています。
        if ($imgs) {
            
            // ↓画像の登録処理
            foreach ($imgs as $img) {
                
                // ↓画像があるのかを真偽判定しています。
                if ($img->isValid()) {

                    
                    $boardreadimg = new Boardreadimg();

                    $boardreadimg->board_id = $board_id;
                    $boardreadimg->boardread_id = $boardread_id;
                    
                    $path = $img->store('image', 'public');
                    $boardreadimg->image_name = 'storage/' . $path;

                    $boardread->created_at = Carbon::now('Asia/Tokyo');
                    $boardread->updated_at = Carbon::now('Asia/Tokyo');

                    $boardreadimg->save();
                }
            }
        }

        // ↓掲示板一覧画面
        return redirect()->route("boards.show", $board_id);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 掲示板コメント削除処理

        $boardread = Boardread::findOrFail($id);

        $board_id = $boardread->board_id;

        $boardreadimgs = Boardreadimg::where("boardread_id", $boardread->id)->get();

        // ↓掲示板に保存されているコメント画像があるのかを真偽判定しています。
        foreach ($boardreadimgs as $boardreadimg) {

            $deletepath = str_replace('storage', '', $boardreadimg->image_name);
            Storage::disk('public')->delete($deletepath);
        
            $boardreadimg->delete();
        }

        // ↓掲示板コメントが削除できているのかを真偽判定しています。
        if ($boardread->delete()) {
            $boards = Board::all();

            $users = User::all();

            // ↓掲示板閲覧画面
            return view("board.show", compact("board_id", $users));
        } else {
            $boardread = Boardread::findOrFail($id);
            $boardreadimgs = Boardreadimg::where('boardread_id', $id)->get();

            $board = Board::where('id', $boardread->board_id)->get();
            $user = User::where('id', $boardread->user_id)->get();

            
            $boardupdeleeerrormessage = "掲示板コメントの削除に失敗しました。";

            // ↓掲示板コメント編集画面
            return view("boardread.edit", compact("boardread", "boardreadimgs", "board", "user", "boardupdeleeerrormessage"));

        }
    }
}
