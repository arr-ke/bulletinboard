// jsのアラート関数

$(function () {
    var countmessage = $('#countmsg').text().trim();
    
    // ↓値があるのかを真偽判定しています。
    if (countmessage) {

        $('#popup-text').text(countmessage);

        setTimeout(function() {
            $('#myPopup').removeClass('hidden');

            setTimeout(function() {
                $('#myPopup').addClass('hidden');
            }, 5000);

        }, 3000);
    }
});