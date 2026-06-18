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
                <form action="">
                    <button type="submit">ログイン</button>
                </form>
            </li>

            <li>
                <form action="">
                    <button type="submit">ユーザー登録</button>
                </form>
            </li>

            <li>
                <!-- ↓未ログイン掲示板一覧画面 -->
                <form action="{{ route('users.index') }}" method="get">
                    <button type="submit">掲示板一覧</button>
                </form>
            </li>
        </ul>
    </nav>
</header>


<br>
<br>
<br>

<form action="" class="form1" method="post">
    <input type="text" name="searchname" class="text1">
    <button type="submit" class="submit1">検索</button>
</form>

<br>
<br>
<br>

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