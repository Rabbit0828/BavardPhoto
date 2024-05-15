<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>アカウントを検索</h1>
        <p>メールアドレスまたはユーザーネームを入力してください。</p>
        <input type="text" id="usernameOrEmail" placeholder="メールアドレスまたはユーザーネーム">
        <button id="nextButton">次へ</button>
    </div>

    <div class="container" id="passwordResetContainer" style="display: none;">
        <h1>パスワードを再設定</h1>
        <p>新しいパスワードを入力してください。</p>
        <input type="password" id="newPassword" placeholder="新しいパスワード">
        <input type="password" id="confirmPassword" placeholder="パスワードを確認">
        <button id="resetButton">パスワードを変更</button>
    </div>

    <script src="script.js"></script>
</body>
</html>
