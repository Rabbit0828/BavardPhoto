document.addEventListener("DOMContentLoaded", function () {
    var text = document.getElementById("text");
    var button = document.getElementById("read-more");
    var originalText = text.innerHTML;
    var truncatedText = text.innerHTML;

    // 一定の文字数で切り取る
    var maxLength = 50; 
    if (truncatedText.length > maxLength) {
        truncatedText = truncatedText.substring(0, maxLength) + '...';
        text.innerHTML = truncatedText;
        button.style.display = 'inline'; // ボタンを表示
    }

    button.addEventListener("click", function () {
        text.innerHTML = originalText;
        button.style.display = 'none'; // ボタンを非表示にする
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("modal");
    var modalImage = document.getElementById("modal-image");
    var closeBtn = document.getElementById("close");

    // すべてのポスト画像を取得
    var postImages = document.querySelectorAll('.post img');

    // 各ポスト画像にクリックイベントを追加
    postImages.forEach(function(img) {
        img.addEventListener('click', function() {
            modal.style.display = "block";
            modalImage.src = this.src;
        });
    });

    // 閉じるボタンのクリックイベント
    closeBtn.addEventListener('click', function() {
        modal.style.display = "none";
    });

    // モーダルウィンドウ外のクリックイベント
    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});

