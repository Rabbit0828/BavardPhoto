<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BavardPhoto</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/chat_update.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        
        #chat-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }
        
        #chat-history {
            max-height: 300px;
            overflow-y: auto;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        #message-form {
            display: flex;
            margin-top: 10px;
        }
        
        #message {
            flex: 1;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
        
        #message[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 15px;
            cursor: pointer;
            border-radius: 3px;
            margin-left: 5px;
        }
        
        #message[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="chat-container">
        <div id="chat-history">
            <?php require_once 'chat_message.php'; ?>
        </div>
        
        <form id="message-form">
            <input type="text" id="message" name="message" placeholder="メッセージを入力してください">
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
                        alert('メッセージが送信されました');
                    },
                    error: function(xhr, status, error) {
                        // リクエストが失敗したときの処理
                        console.log('Error:', error);
                        alert('メッセージの送信に失敗しました');
                    }
                });
            });
        });
    </script>
</body>

</html>


