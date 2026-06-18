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
                    <button type="submit">ログイン</button>
                </form>
            </li>

            <li>
                <form action="">
                    <button type="submit">ユーザー登録</button>
                </form>
            </li>

            <li>
                <!-- ↓未ログイン掲示板一覧画面 -->
                <form action="{{ route('users.index') }}" method="get">
                    <button type="submit">掲示板一覧</button>
                </form>
            </li>
        </ul>
    </nav>
</header>

@foreach ($users as $user)
    @if ($user->id === $board->user_id)
        <h3>{{ $user->name }}さん</h3>
    @endif
@endforeach

<h3>{{ $board->titlename }}</h3>

@foreach ($boardimgs as $boardimg)
    {{ $boardimg->image_name }}
@endforeach



<br>
<br>
<br>

<div class="box1">
    @foreach ($boardreads as $boardread)
        <h3>{{ $boardread->user_name }}さん</h3>
            
        <h3>{{ $boardread->comment }}</h3>

        @foreach ($boardreadimgs as $boardreadimg)
            @if ($boardreadimg->board_id === $boardread->board_id)

                <h3>{{ $boardreadimg->image_name }}</h3>
            @endif
        @endforeach
        </h3>
        <hr>
        <br>
    @endforeach
</div>


@endsection