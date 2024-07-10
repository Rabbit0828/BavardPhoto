<?php session_start();?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャットアプリケーション</title>
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
            <input type="submit" value="送信">
        </form>
    </div>
    
    <script>
    $(document).ready(function() {
        $('#message-form').submit(function(e) {
            e.preventDefault();
            var message = $('#message').val();
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: { message: message },
                success: function(response) {
                    $('#message').val('');
                }
            });
        });
    });
    </script>
</body>
</html>


