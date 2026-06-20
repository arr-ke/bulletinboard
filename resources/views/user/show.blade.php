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

<!-- ↓userテーブルを呼び出しています。 -->
@foreach ($users as $user)
    <!-- ↓usersテーブルのidとboardsテーブルのuser_idが一致しているのかを真偽判定しています。 -->
    @if ($user->id === $board->user_id)
        <h3>{{ $user->name }}さん</h3>
    @endif
@endforeach

<h3>{{ $board->titlename }}</h3>

<!-- ↓boardimgsテーブルを呼び出しています。 -->
@foreach ($boardimgs as $boardimg)
    <h3>{{ $boardimg->image_name }}</h3>
@endforeach



<br>
<br>
<br>

<div class="box2">
    <!-- ↓boardreadsテーブルを呼び出しています。 -->
    @foreach ($boardreads as $boardread)
        <h3>{{ $boardread->user_name }}さん</h3>
            
        <h3>{{ $boardread->comment }}</h3>

        <!-- ↓boardreadimgsテーブルを呼び出しています。 -->
        @foreach ($boardreadimgs as $boardreadimg)
            <!-- ↓boardreadimgsのboardread_idとboardreadのidが一致しているのかを真偽判定しています。 -->
            @if ($boardreadimg->boardread_id == $boardread->id)

                <h3>{{ $boardreadimg->image_name }}</h3>
            @endif
        @endforeach
        </h3>
        <hr>
        <br>
    @endforeach
</div>


@endsection