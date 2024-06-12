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

    // すべてのポストリンクを取得
    var postLinks = document.querySelectorAll('.post-link');

    // 各ポストリンクにクリックイベントを追加
    postLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // デフォルトのリンク動作をキャンセル
            var imageId = this.dataset.imageId; // data-image-id属性から画像IDを取得
            var imageUrl = this.querySelector('img').src; // 画像URLを取得

            // モーダルを表示し、画像を設定
            modal.style.display = "block";
            modalImage.src = imageUrl;
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


