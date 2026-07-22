<!-- 掲示板閲覧画面 -->

@extends('layout.boardapp')

@section('content')

<h1>掲示板閲覧</h1>

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

<!-- ↓userテーブルを呼び出しています。 -->
@foreach ($users as $user)
    <!-- ↓usersテーブルのidとboardsテーブルのuser_idが一致しているのかを真偽判定しています。 -->
    @if ($user->id === $board->user_id)
        <h3>{{ $user->name }}さん</h3>
    @endif
@endforeach

<h3>{{ $board->titlename }}</h3>
<h3>{{ $board->tema }}</h3>

@php
    $count = 0;
@endphp

<!-- ↓boardimgsテーブルを呼び出しています。 -->
@foreach ($boardimgs as $boardimg)
    @php
        $count++;
    @endphp

    <!-- ↓countが1または、6なのかを真偽判定しています。 -->
    @if ($count == 1 || $count == 6)
        <h3>
    @endif
    <img src="{{ asset($boardimg->image_name) }}" height="150" width="200" class="img1">
    <!-- ↓countが5または、10なのかを真偽判定しています。 -->
    @if ($count == 5 || $count == 10)
        </h3>
        <br>
    @endif
@endforeach

<hr>

<br>
<br>
<br>

<div class="box2">
    <!-- ↓boardreadsテーブルを呼び出しています。 -->
    @foreach ($boardreads as $boardread)

        <!-- ↓掲示板コメントの作成日付と更新日付が一致していないのかを真偽判定しています。 -->
        @if ($boardread->created_at != $boardread->updated_at)
            <h3>編集済み</h3>
        @endif

        <a href="{{ route('boardreads.edit', $boardread->id) }}">

        
            <h3>{{ $boardread->user_name }}さん</h3>
                
            <h3>{{ $boardread->comment }}</h3>

            @php
                $count = 0;
            @endphp

            <!-- ↓boardreadimgsテーブルを呼び出しています。 -->
            @foreach ($boardreadimgs as $boardreadimg)
                @php
                    $count++;
                @endphp


                <!-- ↓countが1または、6と掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを真偽判定しています。 -->
                @if ($count == 1 || $count == 6 && $boardread->id === $boardreadimg->boardread_id)
                    <h3>
                @endif

                <!-- ↓掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを -->
                @if ($boardread->id == $boardreadimg->boardread_id)
                    <img src="{{ asset($boardreadimg->image_name) }}" height="150" width="200" class="img1">
                @endif
                
                <!-- ↓countが5または、10掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを真偽判定しています。 -->
                @if ($count == 5 || $count == 10 && $boardread->id === $boardreadimg->boardread_id)
                    </h3>
                    
                @endif
            @endforeach
            
            <hr>
            
    </a>
    @endforeach

    <!-- ↓countが0をこえているかつcountが5と10以外なのかを真偽判定しています。 -->
    @if ($count > 0 && $count != 5 && $count != 10)
        </h3>
    @endif
</div>

<br>
<br>

<!-- ↓ログイン中のuseridとboardsテーブルのuser_idが一致しているのかを真偽判定しています。 -->
@if (Auth::user()->id === $board->user_id)
    <!-- ↓掲示板削除処理 -->
    <form action="{{ route('boards.destroy', $board->id) }}" class="form1" onsubmit="return confirm('削除しますか')" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="submit3">削除</button>
    </form>
@endif

<h3>
    <!-- ↓掲示板作成画面 -->
    <a href="{{ route('boardreads.create', $board->id) }}">コメント書き込み</a>
</h3>


@endsection