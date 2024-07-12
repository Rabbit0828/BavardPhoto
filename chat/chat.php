<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BavardPhoto</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/chat_update.js"></script>
</head>
<body>
    <div id="chat-container">
        <div id="chat-history">
            <?php require_once 'chat_message.php'; ?>
        </div>
        
        <form id="message-form">
            <input type="text" id="message" name="message" placeholder="メッセージを入力してください">
            <input type="hidden" name="recipient_id" value="送信先のユーザーID">
            <button type="button" id="sendButton">送信</button>
        </form>
    </div>
    
    <script>
        $(document).ready(function() {
            $('#sendButton').click(function() {
                const url = new URL(window.location.href);
                const params = url.searchParams;
                // 個別のパラメータを取得
                const recipient_id = params.get('user_id'); // "John"

                // クエリパラメータを取得
                var message = $('#message').val(); // 入力されたメッセージを取得
                
                // Ajaxリクエストを送信
                $.ajax({
                    url: 'send_message.php',
                    method: 'POST',
                    data: { 
                        message: message ,
                        recipient_id:recipient_id

                    }, // メッセージを送信
                    success: function(response) {
                        console.log(response);
                        $('#message').val(''); // 送信後、入力フィールドをクリア
                        
                    },
                    error: function(xhr, status, error) {
                        // リクエストが失敗したときの処理
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>
</body>

</html>


