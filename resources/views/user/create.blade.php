<!-- ユーザー登録画面 -->

@extends('layout.userapp')

@section('content')

<h1>ユーザー登録</h1>

<!-- ↓ユーザー作成エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('createerrormessage')) 
    <div class="msg" style="display:none;">
        {{ session('createerrormessage') }}
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
                    <button type="submit" class="submit1">戻る</button>
                </form>
            </li>

            <br>

            <li>
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


<form action="{{ route('users.store') }}" class="form1" method="post">
    @csrf
    <h3>ID <input type="text" name="id" minlength="5" maxlength="10" pattern="^[a-zA-Z0-9]{5,10}" placeholder="英数字を含む文字数5～10文字以内" class="text4" required></h3>
    <h3>PW <input type="password" name="pw" minlength="5" maxlength="10" pattern="^[a-zA-Z0-9]{10,20}" placeholder="英数字を含む文字数10～20文字以内" class="text5" required></h3>
    <h3>PW確認 <input type="password" name="pwasr" minlength="5" maxlength="10" pattern="^[a-zA-Z0-9]{10,20}" placeholder="英数字を含む文字数10～20文字以内" class="text6" required></h3>

    <br>
    <br>

    <button type="submit" class="submit3">作成</button>
</form>


@endsection