<!-- ログイン後エラー画面 -->

@extends('layout.boardapp')

@section('content')

<h1>エラー</h1>

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
                <!-- ログアウト処理 -->
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
<br>


<!-- ↓リンクエラーなのかを真偽判定しています。 -->
@if (session('value') == '1')
    <h3 class="fontsize1">リンクエラーです。</h3>
    <h3 class="fontsize1">000-0000-0000</h3>
    <h3 class="fontsize1">この電話にご連絡ください。</h3>
<!-- ↓原因不明エラーなのかを真偽判定しています。 -->
@elseif (session('value') == '2')
    <h3 class="fontsize1">原因不明エラーです。</h3>
    <h3 class="fontsize1">000-0000-0000</h3>
    <h3 class="fontsize1">この電話にご連絡ください。</h3>
@endif

@endsection