<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
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
        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
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
        .return-button {
            background-color: white;
            color: #DC34E0;
            border: 1px solid #DC34E0;
        }
        .return-button:hover {
            background-color: #f4e1f8;
            color: #b02db3;
        }
        @media (max-width: 800px) {
            .container {
                padding: 20px;
            }
            .container h1 {
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
            .container h1 {
                font-size: 18px;
            }
            button {
                font-size: 12px;
                padding: 6px;
            }
        }
    </style>
</head>
<body>
    <div class="container" id="searchContainer">
        <form method="POST" action="output.php">
            <h2>アカウントを検索</h2>
            <p>パスワードを再設定したいアカウントの、メールアドレスまたはユーザーネームを入力してください。</p>
            <input type="text" name="usernameOrEmail" class="input-box" placeholder="メールアドレスまたはユーザーネーム" required>
            <button type="submit">次へ</button>
        </form>
        <a href="../G2-1/G2-1.php"><button type="button" class="return-button">戻る</button></a>
    </div>
</body>
</html>
