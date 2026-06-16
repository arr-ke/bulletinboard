$(function () {
    // ↓ハンバーガーメニューのボタンがクリックされたときの処理
    $('.hamburger').click(function () {
        $(this).toggleClass('active');
        $('#header .nav').toggleClass('active');
    });

    // ↓メニュー内のリンクがクリックされた時
    $('.nav a').click(function () {
        $('.hamburger').removeClass('active');
        $('#header .nav').removeClass('active');
    });
});