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
    public function create(Boardreadrequest $request)
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
    public function store(Request $request)
    {
        //
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
}
