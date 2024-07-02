<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>リアルタイムチャット</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // メッセージ送信
        $('#bms_send_btn').click(function() {
            var message = $('#bms_send_message').val().trim();
            if (message !== '') {
                $.ajax({
                    url: 'send_message.php',
                    type: 'POST',
                    data: { message: message },
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            appendMessage('あなた', message, 'bms_right');
                            $('#bms_send_message').val('');
                        } else {
                            alert('メッセージの送信に失敗しました。');
                        }
                    },
                    error: function() {
                        alert('メッセージの送信に失敗しました。');
                    }
                });
            }
        });

        // 定期的にメッセージを取得
        setInterval(fetchMessages, 3000); // 3秒ごとにメッセージを取得

        // メッセージ取得
        function fetchMessages() {
            $.ajax({
                url: 'get_messages.php',
                type: 'GET',
                success: function(response) {
                    var messages = JSON.parse(response);
                    $('#bms_messages').html('');
                    messages.forEach(function(msg) {
                        var alignment = (msg.user === 'あなた') ? 'bms_right' : 'bms_left';
                        appendMessage(msg.user, msg.message, alignment);
                    });
                    scrollToBottom();
                },
                error: function() {
                    alert('メッセージの取得に失敗しました。');
                }
            });
        }

        // 新しいメッセージを表示する
        function appendMessage(user, message, alignment) {
            $('#bms_messages').append(
                '<div class="bms_message ' + alignment + '">' +
                '<div class="bms_message_box">' +
                '<div class="bms_message_content">' +
                '<div class="bms_message_text">' + message + '</div>' +
                '</div>' +
                '</div>' +
                '</div><div class="bms_clear"></div>'
            );
        }

        // メッセージ表示領域を一番下までスクロールする
        function scrollToBottom() {
            $('#bms_messages').scrollTop($('#bms_messages')[0].scrollHeight);
        }
    });
    </script>
</head>
<body>
    <div id="bms_messages">
        <!-- メッセージ表示領域 -->
    </div>
    <textarea id="bms_send_message"></textarea>
    <button id="bms_send_btn">送信</button>
</body>
</html>


