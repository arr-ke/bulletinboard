<!-- ユーザー編集画面 -->

@extends('layout.userapp')

@section('content')

<h1>ユーザー編集</h1>

<!-- ↓ユーザー作成エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('userupdateerrormessage')) 
    <div id="msg" style="display:none;">
        {{ session('userupdateerrormessage') }}
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

<!-- ↓ユーザー更新処理 -->
<form action="{{ route('users.update', $user->id) }}" class="form1" method="post">
    @csrf

    @method('PATCH')

    <h3>PW <input type="password" name="pw" minlength="10" maxlength="20" value="{{ old('pw') }}" pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{10,20}$" placeholder="英数字を含む文字数10～20文字以内" class="text5" required></h3>

    <h3>PW確認 <input type="password" name="pwasr" minlength="10" maxlength="20" value="{{ old('pwasr') }}" pattern="^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]{10,20}$" placeholder="英数字を含む文字数10～20文字以内" class="text6" required></h3>

    <br>
    <br>

    <button type="submit" class="submit3">更新</button>
</form>


@endsection