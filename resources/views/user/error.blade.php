<!-- 未ログインエラー画面 -->

@extends('layout.userapp')

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