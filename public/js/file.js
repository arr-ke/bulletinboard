// ↓ファイルサイズとファイル枚数をチェックをする関数
function checkFileSizeAndCount(inputElement, maxMb = 10, maxCount = 10) {
    const files = inputElement.files;
    if (!files || files.length === 0) return;

    if (files.length > maxCount) {
        alert(`画像の上限は${maxCount}枚まで`);
        inputElement.value = '';
        return;
    }

    const maxSize = maxMb * 1024 * 1024;
    for (const file of files) {
        if (file.size > maxSize) {
            alert(`ファイルサイズは${maxMb}MB以下まで`);
            // ↓jQueryでリセット
            inputElement.value = '';
            return;
        }  
    }
     
}

// ↓ページ読み込み完了後にイベントを設定
$(function() {
    $('input[type="file"]').on('change', function() {
        // ↓関数をよびだしている。
        checkFileSizeAndCount(this);
    })
})