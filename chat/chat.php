<!-- chat.php -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャットアプリケーション</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="chat_update.js"></script>
</head>
<body>
    <div id="chat-container">
        <!-- チャット履歴の表示 -->
        <div id="chat-history">
            <?php require_once 'chat_message.php'; ?>
        </div>

        <!-- メッセージ送信フォーム -->
        <form id="message-form">
            <input type="text" id="message" name="message" placeholder="メッセージを入力してください">
            <input type="submit" value="送信">
        </form>
    </div>

    <script>
    $(document).ready(function() {
        // フォームの送信をAJAXで処理
        $('#message-form').submit(function(e) {
            e.preventDefault();
            var message = $('#message').val();
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: { message: message },
                success: function(response) {
                    $('#message').val(''); // 入力フィールドをクリア
                }
            });
        });
    });
    </script>
</body>
</html>


