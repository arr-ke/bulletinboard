<!-- 掲示板作成画面 -->

@extends('layout.boardreadapp')

@section('content')

<h1>掲示板コメント作成</h1>

<!-- ↓ユーザー作成エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('boardreadcreateerrormessage')) 
    <div id="msg" style="display:none;">
        {{ session('boardreadcreateerrormessage') }}
    </div>
@endif

<header id="header">
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav class="nav">
        <ul>

            <li>
                <h3>{{ Auth::user()->name }}さん</h3>
            </li>

            <li>
                <!-- ↓ログアウト処理 -->
                <form action="{{ route('boards.logout') }}" method="get" onsubmit="return confirm('ログアウトしますか')">
                    <button type="submit" class="submit1">ログアウト</button>
                </form>
            </li>

            <br>

            <li>
                <form action="" method="">
                    <button type="submit" class="submit1">ユーザー編集</button>
                </form>
            </li>

            <br>

            <li>
                <!-- ↓未ログイン掲示板一覧画面 -->
                <form action="{{ route('boards.index') }}" method="get">
                    <button type="submit" class="submit1">掲示板一覧</button>
                </form>
            </li>

            <br>

            <li>
                <!-- ↓未ログイン掲示板一覧画面 -->
                <form action="{{ route('boards.show', $board->id) }}" method="get">
                    <button type="submit" class="submit1">掲示板閲覧</button>
                </form>
            </li>

        </ul>
    </nav>
</header>

<!-- ↓掲示板作成処理 -->
<form action="{{ route('boardreads.store') }}" enctype="multipart/form-data" class="form1" method="post">
    @csrf
    <h3>ユーザー名（ログイン名以外も可）</h3>
    <input type="text" name="username" value="{{ old('titlename') }}" maxlength="50" placeholder="50文字以内" class="text2" required>

    <h3>掲示板コメント</h3>
    <textarea name="comment" rows="8" cols=30" value="{{ old('tema') }}" class="text3" placeholder="100文字以内" maxlength="100" required></textarea>

    <h3>掲示板コメント画像</h3>
    <input type="file" name="img[]" multiple>

    <input type="hidden" name="boardid" value="{{ $board->id }}">

    <br>
    <br>

    <button type="submit" class="submit3">作成</button>
</form>

@endsection