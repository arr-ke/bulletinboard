<!-- 掲示板作成画面 -->

@extends('layout.boardapp')

@section('content')

<h1>掲示板作成</h1>

<!-- ↓ユーザー作成エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('boardcreateerrormessage')) 
    <div id="msg" style="display:none;">
        {{ session('boardcreateerrormessage') }}
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
        </ul>
    </nav>
</header>

<form action="{{ route('boards.store') }}" class="form1" method="post">
    @csrf
    <h3>掲示板タイトル</h3>
    <input type="text" name="titlename" value="{{ old('titlename') }}" maxlength="50" placeholder="50文字以内" class="text2" required>

    <h3>掲示板テーマ</h3>
    <textarea name="tema" rows="8" cols=30" value="{{ old('tema') }}" class="text3" placeholder="100文字以内" maxlength="100" required></textarea>

    <br>
    <br>

    <button type="submit" class="submit3">作成</button>
</form>

@endsection