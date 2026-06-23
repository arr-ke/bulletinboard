<!-- 未ログイン掲示板一覧画面 -->

@extends('layout.userapp')

@section('content')

<h1>ログイン</h1>

<!-- ↓リンクエラーなのかを真偽判定しています。 -->
@if (session('loginmessage')) {
    <div class="msg" style="display:none;">
        {{ session('loginmessage') }}
    </div>
}

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
                <form action="">
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


<form action="{{ route('users.login') }}" class="form1" method="post">
    <h3>ID <input type="text" name="id" class="text2"></h3>
    <h3>PW <input type="text" name="pw" class="text3"></h3>

    <br>
    <br>

    <button type="submit" class="submit3">ログイン</button>
</form>


@endsection