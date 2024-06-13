// ページが読み込まれたときの処理
document.addEventListener("DOMContentLoaded", function() {
    // メッセージ送信ボタンのクリックイベント
    document.getElementById("send-button").addEventListener("click", function() {
        sendMessage();
    });

    // 初回メッセージ取得と表示
    getAndDisplayMessages();

    // 定期的にメッセージを取得して表示
    setInterval(function() {
        getAndDisplayMessages();
    }, 5000); // 5秒ごとに更新

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
                getAndDisplayMessages(); // 新しいメッセージを取得して表示
            }
        };
        xhr.send("message=" + encodeURIComponent(message) + "&receiver_id=" + receiverId);
    }

    // チャットメッセージを取得して表示する関数
    function getAndDisplayMessages() {
        var receiverId = <?php echo $receiverId; ?>; // 受信者のユーザーIDをPHPから取得

        // Ajaxリクエストの送信
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "get_messages.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // メッセージを取得して表示
                var messages = JSON.parse(xhr.responseText);
                displayMessages(messages);
            }
        };
        xhr.send("receiver_id=" + receiverId);
    }

    // チャットメッセージを表示する関数
    function displayMessages(messages) {
        var chatMessages = document.getElementById("chat-messages");
        chatMessages.innerHTML = ""; // メッセージエリアをクリア

        messages.forEach(function(message) {
            var messageElement = document.createElement("div");
            messageElement.textContent = message.sender_id + ": " + message.message_text;
            chatMessages.appendChild(messageElement);
        });
    }
});


