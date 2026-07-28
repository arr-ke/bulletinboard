<!-- 掲示板コメント編集画面 -->

@extends('layout.boardreadapp')

@section('content')

<h1>掲示板コメント編集</h1>

<!-- ↓掲示板コメント編集エラーメッセージがあるのかを真偽判定しています。 -->
@if (session('boardupdeleteerrormessage')) 
    <div id="msg" style="display:none;">
        {{ session('boardupdeleteerrormessage') }}
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

            <br>

            <li>
                <!-- ↓未ログイン掲示板一覧画面 -->
                <form action="{{ route('boards.show', $boardread->board_id) }}" method="get">
                    <button type="submit" class="submit1">掲示板閲覧</button>
                </form>
            </li>

            
        </ul>
    </nav>
</header>

<!-- ↓掲示板コメント編集処理 -->
<form action="{{ route('boardreads.update', $boardread->id) }}" enctype="multipart/form-data" class="form1" method="post">
    @csrf

    @method('PATCH')

    <h3>ユーザー名（ログイン名以外も可）</h3>
    @if (old('username'))
        <input type="text" name="username" value="{{ old('username') }}" maxlength="50" placeholder="50文字以内" class="text2" required>
    @else
        <input type="text" name="username" value="{{ $boardread->user_name }}" maxlength="50" placeholder="50文字以内" class="text2" required>
    @endif

    <h3>掲示板コメント</h3>
    @if (old('comment'))
        <textarea name="comment" rows="8" cols="30" class="text3" placeholder="100文字以内" maxlength="100" required>{{ old('comment') }}</textarea>
    @else
        <textarea name="comment" rows="8" cols=30" class="text3" placeholder="100文字以内" maxlength="100" required>{{ $boardread->comment }}</textarea>
    @endif   

    <h3>掲示板コメント画像</h3>

    <div class="box2">
        <!-- ↓boardreadsテーブルを呼び出しています。 -->
        @php
            $count = 0;
        @endphp


        <!-- ↓boardreadimgsテーブルを呼び出しています。 -->
        @foreach ($boardreadimgs as $boardreadimg)
            @php
                $count++;
            @endphp

            <!-- ↓countが1または、6と掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを真偽判定しています。 -->
            @if ($count == 1 || $count == 6)
                <h3>
            @endif

            <!-- ↓掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを -->

                画像{{ $count }}
                <br>

                
                    <img src="{{ asset($boardreadimg->image_name) }}" height="100" width="150" class="img1">
                

                <br>

                
                    <select name="imgselect[{{ $boardreadimg->id }}]">
                        <option value="0">画像を削除しない</option>
                        <option value="1">画像を削除する</option>
                    </select>
                <br>

            <!-- ↓countが掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを真偽判定しています。 -->
            @if ($count == 5)
                
                </h3>
                
                <h3>
            @elseif ($count == 10)
                </h3>
            @endif

        @endforeach

        <!-- ↓countが0なのかを真偽判定しています。 -->
        @if ($count == 0)
            <h3>コメント画像はありません</h3>
        @endif
    </div>

    <br>

    <input type="file" name="img[]" multiple>

    <input type="hidden" name="boardid" value="{{ $boardread->board_id }}">
    
    <input type="hidden" name="boardreadid" value="{{ $boardread->id }}">

    <br>
    <br>

    <button type="submit" class="submit3">更新</button>
</form>

<hr>

<br>



<!-- ↓ログイン中のuseridとboardsテーブルのuser_idが一致しているのかを真偽判定しています。 -->
@if (Auth::user()->id === $boardread->user_id)
    <!-- ↓掲示板コメント削除処理 -->
    <form action="{{ route('boardreads.destroy', $boardread->id) }}" class="form1" onsubmit="return confirm('削除しますか')" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="submit3">削除</button>
    </form>
@endif


@endsection