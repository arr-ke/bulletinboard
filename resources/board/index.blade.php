<!-- 掲示板一覧画面 -->

@extends('layout.boardapp')

@section('content')

<h1>掲示板一覧</h1>

<!-- ↓ログインメッセージがあるのかを真偽判定しています。 -->
@if (session('loginmessage')) 
    <div class="msg" style="display:none;">
        {{ session('loginmessage') }}
    </div>
@endif

<!-- ↓エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('errormessage')) 
    <div class="msg" style="display:none;">
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
                <form action="{{ route('users.login') }}" method="post">
                    @csrf
                    <button type="submit" class="submit1">ログイン</button>
                </form>
            </li>

            <br>

            <li>
                <form action="{{ route('users.create') }}" method="post">
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

<form action="" class="form1" method="post">
    @csrf
    <input type="text" name="searchname" class="text1">
    <button type="submit" class="submit2">検索</button>
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

<h3>
    <a href="">掲示板作成</a>
</h3>

@endsection