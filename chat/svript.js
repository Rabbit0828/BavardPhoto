$(document).ready(function() {
    // メッセージ送信ボタンがクリックされたときの処理
    $('#send-btn').click(function() {
        var message = $('#message-input').val(); // 入力されたメッセージを取得
        if (message !== '') {
            sendMessage(message); // メッセージを送信
            $('#message-input').val(''); // 入力欄を空にする
        }
    });

    // メッセージを送信する関数
    function sendMessage(message) {
        // ここでAjaxリクエストを送信してサーバーにメッセージを送信する
        // 送信後にメッセージを表示するなどの処理を追加する
        var formattedMessage = '<div class="message sent">' + message + '</div>';
        $('#chat-box').append(formattedMessage);
    }

    // 定期的に新しいメッセージを受信する関数（ダミーデータを使用）
    setInterval(function() {
        receiveMessage('Hello! How are you?');
    }, 3000); // 3秒ごとにメッセージを受信
});

// 新しいメッセージを受信する関数
function receiveMessage(message) {
    var formattedMessage = '<div class="message received">' + message + '</div>';
    $('#chat-box').append(formattedMessage);
}
