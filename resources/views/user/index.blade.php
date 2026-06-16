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
                    <button type="submit" onclick="">ログイン</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

<form action="">
    <input type="text">
    <button type="submit">検索</button>
</form>

@foreach ($boards as $board)
    <h3>{{ $board->titlename }}</h3>
@endforeach

@endsection