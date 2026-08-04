<!-- 未ログイン掲示板一覧画面 -->

@extends('layout.userapp')

@section('content')

<h1>掲示板一覧</h1>

<header id="header">
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav class="nav">
        <ul>
            <li>
                <!-- ↓ログイン画面 -->
                <form action="{{ route('users.logininput') }}" method="get">
                    @csrf
                    <button type="submit" class="submit1">ユーザーログイン</button>
                </form>
            </li>

            <br>

            <li>
                <!-- ↓ユーザー登録画面 -->
                <form action="{{ route('users.create') }}" method="get">
                    <button type="submit" class="submit1">ユーザー登録</button>
                </form>
            </li>

            <br>

            <li>
                <!-- ↓未ログイン掲示板一覧画面 -->
                <form action="{{ route('users.index') }}" method="get">
                    <button type="submit" class="submit1">掲示板一覧</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<br>
<br>
<br>

<!-- ↓未ログイン掲示板検索処理 -->
<form action="{{ route('users.search') }}" class="form1" method="post">
    @csrf

    <input type="text" name="searchname" value="{{ $searchname }}" class="text1" required>

    <button type="submit" class="submit2">検索</button>
</form>

<br>
<br>

<!-- 掲示板名がをNULLではないのかを真偽判定しています。 -->
@if ($searchname != NULL)
    <h3>ヒット数は{{ $count }}件です。</h3>
@endif

<div class="box1">
    @foreach ($boards as $board)
        <h3>
            <!-- ↓未ログイン掲示板閲覧画面 -->
            <a href="{{ route('users.show', $board->id) }}">
                {{ $board->titlename }}
            </a>
        </h3>
        <br>
    @endforeach
</div>

@endsection