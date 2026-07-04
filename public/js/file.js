// ↓ファイルサイズチェックをする関数
function checkFileSize(inputElement, maxMb = 10) {
    const file = inputElement.files[0];
    if (!file) return;

    const maxSize = maxMb * 1024 * 1024;

    if (file.size > maxSize) {
        alert(`ファイルサイズは${maxMb}MB以下にしてください。`);
        // ↓jQueryでリセット
        $(inputElement).val('');
    }   
}

// ↓ページ読み込み完了後にイベントを設定
$(function() {
    $('input[type="file"]').on('change', function() {
        // ↓関数をよびだしている。
        checkFileSize(this);
    })
})