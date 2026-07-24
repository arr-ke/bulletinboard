<!-- 掲示板一覧画面 -->

@extends('layout.boardapp')

@section('content')

<h1>掲示板一覧</h1>

<!-- ↓エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('errormessage')) 
    <div id="msg" style="display:none;">
        {{ session('errormessage') }}
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
                <!-- ↓ユーザー編集画面 -->
                <form action="{{ route('users.edit', Auth::user()->id) }}" method="get">
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

<br>
<br>
<br>

<form action="{{ route('boards.search') }}" class="form1" method="post">
    @csrf

    <!-- ↓検索値があるのかを真偽判定しています。 -->
    @if (session('searchname'))
        <input type="text" name="searchname" value="{{ session('searchname') }}" class="text1">
    @else
        <input type="text" name="searchname" class="text1">
    @endif

    <button type="submit" class="submit2">検索</button>
</form>

<br>
<br>
<br>

<div class="box1">
    @foreach ($boards as $board)
        <h3>
            <!-- ↓未ログイン掲示板閲覧画面 -->
            <a href="{{ route('boards.show', $board->id) }}">
                {{ $board->titlename }}
            </a>
        </h3>
        <br>
    @endforeach
</div>

<h3>
    <!-- ↓掲示板作成画面 -->
    <a href="{{ route('boards.create') }}">掲示板作成</a>
</h3>

@endsection