// jsのアラート関数

$(function () {
    var message = $('#msg').text().trim();
    
    // ↓値があるのかを真偽判定しています。
    if (message) {
        alert(message);
    }
});