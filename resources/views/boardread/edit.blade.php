<!-- 掲示板コメント編集画面 -->

@extends('layout.userapp')

@section('content')

<h1>掲示板コメント編集</h1>

<!-- ↓ユーザー作成エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('boarddeleteerrormessage')) 
    <div id="msg" style="display:none;">
        {{ session('boarddeleteerrormessage') }}
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
                <form action="" method="">
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

<!-- ↓掲示板作成処理 -->
<form action="{{ route('boardreads.update', $boardread->id) }}" enctype="multipart/form-data" class="form1" method="post">
    @csrf
    <h3>ユーザー名（ログイン名以外も可）</h3>
    @if (old('titlename'))
        <input type="text" name="username" value="{{ old('username') }}" maxlength="50" placeholder="50文字以内" class="text2" required>
    @else
        <input type="text" name="username" value="{{ $boardread->username }}" maxlength="50" placeholder="50文字以内" class="text2" required>
    @endif

    <h3>掲示板コメント</h3>
    @if (old('comment'))
        <textarea name="comment" rows="8" cols=30" value="{{ old('comment') }}" class="text3" placeholder="100文字以内" maxlength="100" required></textarea>
    @else
        <textarea name="comment" rows="8" cols=30" value="{{ $boardread->comment }}" class="text3" placeholder="100文字以内" maxlength="100" required></textarea>
    @endif   

    <h3>掲示板コメント画像</h3>

    <div class="box2">
        <!-- ↓boardreadsテーブルを呼び出しています。 -->


        <!-- ↓boardreadimgsテーブルを呼び出しています。 -->
        @foreach ($boardreadimgs as $boardreadimg)


            <!-- ↓countが1または、6と掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを真偽判定しています。 -->
            @if ($count == 1 || $count == 6 && $boardread->id === $boardreadimg->boardread_id)
                <h3>
            @endif

            <!-- ↓掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを -->
            @if ($boardread->id == $boardreadimg->boardread_id)
                <img src="{{ asset($boardreadimg->image_name) }}" height="70" width="120" class="img1">
            @endif
            
            <!-- ↓countが5または、10掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを真偽判定しています。 -->
            @if ($count == 5 || $count == 10 && $boardread->id === $boardreadimg->boardread_id)
                </h3>
                <br>
            @endif
        @endforeach
    </div>

    <input type="file" name="img[]" multiple>

    <input type="hidden" name="boardid" value="{{ $board->id }}">

    <br>
    <br>

    <button type="submit" class="submit3">作成</button>
</form>

<hr>

<br>
<br>
<br>


<br>
<br>

<!-- ↓ログイン中のuseridとboardsテーブルのuser_idが一致しているのかを真偽判定しています。 -->
@if (Auth::user()->id === $board->user_id)
    <!-- ↓削除処理 -->
    <form action="{{ route('boardreads.destroy', $boardread->id) }}" class="form1" onsubmit="return confirm('削除しますか')" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="submit3">削除</button>
    </form>
@endif


@endsection