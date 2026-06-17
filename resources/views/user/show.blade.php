<!-- 未ログイン掲示板閲覧画面 -->

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
                <form action="">
                    <button type="submit">掲示板一覧</button>
                </form>
            </li>
        </ul>
    </nav>
</header>


<h3>{{ $board->titlename }}</h3>


<br>
<br>
<br>


@endsection