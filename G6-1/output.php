<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="G6-1.css">
</head>
<body>
    <div class="container" id="searchContainer">
        <h1>アカウントを検索</h1>
        <p>メールアドレスまたはユーザーネームを入力してください。</p>
        <form method="POST" action="output.php">
            <input type="text" name="usernameOrEmail" class="input-box" placeholder="メールアドレスまたはユーザーネーム" required>
            <div class="spacer"></div>
            <button type="submit" name="search" class="action-button">次へ</button>
        </form>
    </div>
</body>z
</html>
