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
use Carbon\Carbon;
use Exception;

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
            return redirect()->route('users.error')->with('value', "1");
        }

        try {
            $boards = Board::all();
            $searchname = null;

            // ↓未ログイン掲示板一覧画面
            return view("user.index", compact("boards", "searchname"));
        // ↓原因不明エラー起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "2");
        }
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.create')) {
            // ↓エラー画面
            return redirect()->route('users.error')->with('value', "1");
        }

        try {
            // ↓ユーザー登録画面
            return view("user.create");
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "2");
        }

        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        // ↓pwとpwasrの値が一致しているのかを真偽判定しています。
        if ($request->input("pw") === $request->input("pwasr")) {
            // ↓usersテーブルに同じidがあるのかを真偽判定しています。
            if (User::where('name', $request->input('id'))->exists()) {
                // ↓ユーザー登録画面
                return redirect()->route("users.create")
                ->with('usercreateerrormessage', "ユーザーIDがすでに使われています")
                ->withInput();
            }

            // ユーザー登録処理
            $name = $request->input("id");
            $pw = $request->input("pw");

            $user = new User();
            $user->name = $name;
            $user->password = $pw;
            $user->created_at = Carbon::now('Asia/Tokyo');
            $user->updated_at = Carbon::now('Asia/Tokyo');

            $user->save();

            // ↓ログイン画面
            return view("user.logininput");

        } else {
            // ↓ユーザー登録画面
            return redirect()->route("users.create")
            ->with('usercreateerrormessage', "ユーザー登録に失敗しました")
            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.show')) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "1");
        }

        try {
            $users = User::all();
            $board = Board::findOrFail($id);
            $boardimgs = Boardimg::where("board_id", $id)->get();
            $boardreads = Boardread::where("board_id", $id)->get();
            $boardreadimgs = Boardreadimg::all();
            
            // ↓未ログイン掲示板閲覧画面
            return view("user.show", compact("users", "board", "boardimgs", "boardreads", "boardreadimgs"));
        // ↓原因不明エラーが起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "2");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.edit')) {
            // ↓エラー画面
            return redirect()->route("boards.error")->with('value', "1");
        }

        try {
            $user = User::findOrFail($id);
            
            // ↓未ログイン掲示板閲覧画面
            return view("user.edit", compact("user"));
        // ↓原因不明エラーが起きた時
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("boards.error")->with('value', "2");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // ユーザー更新処理

        // ↓pwとpwasrの値が一致しているのかを真偽判定しています。
        if ($request->input("pw") === $request->input("pwasr")) {
            $pw = $request->input("pw");

            $user = User::findOrFail($id);

            $user->password = $pw;
            
            $user->updated_at = Carbon::now('Asia/Tokyo');

            $user->save();

            $boards = Board::all();

            // ↓掲示板一覧画面
            return view("board.index", compact("boards"));
        } else {
            $user = User::findOrFail($id);

            // ↓ユーザー編集画面
            return view("users.edit", compact("user"))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logininput() {
        
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.logininput')) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "1");
        }

        try {
            
            // ↓ログイン画面
            return view("user.logininput");
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "2");
        }
    }

    public function loginoutput(UserRequest $request) {
    
        // ↓IDとPWに値が入力されているのかを真偽判定しています。
        if ($request->filled('id') && $request->filled('pw')) {
            
            // ↓ログイン処理
            $login = [
                'name' => $request->input('id'),
                'password' => $request->input('pw'),
            ];
            
            // ↓ログインしているのかを真偽判定しています。
            if (Auth::attempt($login)) {

                // ↓掲示板一覧画面
                return redirect()->route("boards.index");
            }
            // ↓ログイン画面
            return redirect()->route("users.logininput")->with('loginmessage', "ログインに失敗しました");
        } else {
            // ↓ログイン画面
            return redirect()->route("users.logininput")->with('loginmessage', "IDとPWを入力してください");
        }
    }

    public function error(UserRequest $request) {
        // ↓エラー画面
        return view("user.error"); 
    }

    public function search(UserRequest $request) {
        // ↓リンクエラーが起きていないのかを真偽判定しています。
        if (!view()->exists('user.index')) {
            // ↓エラー画面
            return redirect()->route('users.error')->with('value', "1");
        }

        $searchname = $request->input("searchname");

        try {
            // ↓検索値が入力されているのかを真偽判定しています。
            if (filled($searchname)) {
                $query = board::orderBy("id");

                // ↓掲示板名を掲示板テーブルのtitlenameから検索しています。
                $query->where('titlename', 'LIKE', '%' . $searchname . '%');

                $boards = $query->get();

                // ↓未ログイン掲示板一覧画面
                return view("user.index", compact("boards", "searchname"));
            } else {
                $boards = Board::all();

                // ↓未ログイン掲示板一覧画面
                return view("user.index", compact("boards", "searchname"));
            }
        } catch (Exception $e) {
            // ↓エラー画面
            return redirect()->route("users.error")->with('value', "2");
        }
    }
}
