// ページが読み込まれたときの処理
document.addEventListener("DOMContentLoaded", function() {
    // メッセージ送信ボタンのクリックイベント
    document.getElementById("send-button").addEventListener("click", function() {
        sendMessage();
    });

    // メッセージを送信する関数
    function sendMessage() {
        var message = document.getElementById("message-text").value;
        var receiverId = <?php echo $receiverId; ?>; // 受信者のユーザーIDをPHPから取得

        // Ajaxリクエストの送信
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "send_message.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // メッセージが送信された後の処理
                document.getElementById("message-text").value = ""; // テキストエリアをクリアするなど
            }
        };
        xhr.send("message=" + encodeURIComponent(message) + "&receiver_id=" + receiverId);
    }
});

