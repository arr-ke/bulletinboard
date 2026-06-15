<!-- 未ログイン掲示板一覧画面 -->

@extends('layout.userapp')

@section('content')

<h1>掲示板一覧</h1>

<form action="">
    <button type="submit">ログイン</button>
</form>

<form action="">
    <input type="text">
    <button type="submit">検索</button>
</form>

@foreach ($boards as $board)
    <h3>{{ $board->titlename }}</h3>
@endforeach

@endsection