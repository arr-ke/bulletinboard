<!-- boardのappファイル -->
<!DOCTYPE html>
<html land="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/board.css') }}">
    <title>user</title>
    <!-- ↓インターネット上のjQueryのライブラリーを読み込んでいます。 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{ asset('js/hamburger.js') }}"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
</head>
<body>
    
    @yield('content')
</body>
</html>