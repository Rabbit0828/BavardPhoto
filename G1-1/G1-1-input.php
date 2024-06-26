<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="css/style.css"> <!-- 必要に応じてスタイルシートのパスを修正 -->

    <script>
        // ページが戻ったときにリロードするためのスクリプト
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 830px;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
        }

        /* .container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        } */

        .container p {
            margin-bottom: 20px;
            color: #666;
        }
        .input-box {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #DC34E0;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
        }
        button:hover {
            background-color: #b02db3;
        }
        .register-button {
            background-color: white;
            color: #DC34E0;
            border: 1px solid #DC34E0;
        }
        .register-button:hover {
            background-color: #f4e1f8;
            color: #b02db3;
        }
        @media (max-width: 800px) {
            .container {
                padding: 20px;
            }
            .container h2 {
                font-size: 20px;
            }
            button {
                font-size: 14px;
                padding: 8px;
            }
        }
        @media (max-width: 500px) {
            .container {
                padding: 10px;
            }
            .container h2 {
                font-size: 18px;
            }
            button {
                font-size: 12px;
                padding: 6px;
            }
        }

        .logo {
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="logo">
    <img src="../images/logo.png" alt="ロゴ">
    </div>
        <form action="G1-1-output.php" method="post">
            
            <input type="text" name="user_id" class="input-box" placeholder="ユーザーネーム、メールまたは携帯電話でログイン" required>
            <input type="password" name="password" class="input-box" placeholder="パスワードを入力" required>
            <button type="submit">ログイン</button>
        </form>
        <a href="../G1-2/G1-2-1-input.php"><button type="button" class="register-button">新しいアカウントを作成</button></a>
    </div>
</body>
</html>
