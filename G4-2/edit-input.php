<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>プロフィール編集</title>
    </head>
    <body>
        <form action="edit-output.php" method="POST">
        <div>    
            <span>ユーザーネーム</span>
            <input type="text" name="user_name"  placeholder="ユーザーネームを変更">
        </div>
        <div>
            <span>名前</span>
            <input type="text" name="name"  placeholder="名前を変更">
        </div>
        <div>
            <span>自己紹介</span>
            <input type="text" name="shoukai"  placeholder="自由に変更">
        </div>
            <button type="submit">変更</button>
        </div>
    </body>
</html>

<!--css-->
<style>
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        div {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        span {
            width: 120px;
            font-weight: bold;
            margin-bottom: 0;
            color:#777;
        }

        input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 2px solid #DC34E0;
            border-radius: 4px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #dd4ae0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        button:hover {
            background-color: #db07e7;
        }
        </style>