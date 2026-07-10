<!-- 未ログイン掲示板閲覧画面 -->

@extends('layout.userapp')

@section('content')

<h1>掲示板閲覧</h1>

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

    <!-- ↓掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを -->
    @if ($boardread->id == $boardreadimg->boardread_id)
        <img src="{{ asset($boardreadimg->image_name) }}" height="50" width="100" class="img1">
    @endif

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


            <!-- ↓countが1または、6なのかを真偽判定しています。 -->
            @if ($count == 1 || $count == 6)
                <h3>
            @endif

            <!-- ↓掲示板コメントidと掲示板コメント画像の掲示板コメントidが一致しているのかを -->
            @if ($boardread->id == $boardreadimg->boardread_id)
                <img src="{{ asset($boardreadimg->image_name) }}" height="50" width="100" class="img1">
            @endif
            
            <!-- ↓countが5または、10なのかを真偽判定しています。 -->
            @if ($count == 5 || $count == 10)
                </h3>
                <br>
            @endif
        @endforeach
        
        <hr>
        <br>
    @endforeach
</div>


@endsection