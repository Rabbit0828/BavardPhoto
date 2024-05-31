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
