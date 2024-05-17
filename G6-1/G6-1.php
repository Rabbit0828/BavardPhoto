<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="G6-1.css">
</head>
<body>
    <div class="container">
        <h1>アカウントを検索</h1>
        <p>メールアドレスまたはユーザーネームを入力してください。</p>
        <input type="text" id="usernameOrEmail" class="input-box" placeholder="メールアドレスまたはユーザーネーム">
        <div class="spacer"></div>
        <button id="nextButton" class="action-button">次へ</button>
    </div>

    <div class="container" id="passwordResetContainer" style="display: none;">
        <h1>パスワードを再設定</h1>
        <p>新しいパスワードを入力してください。</p>
        <input type="password" id="newPassword" class="input-box" placeholder="新しいパスワード">
        <div class="spacer"></div>
        <input type="password" id="confirmPassword" class="input-box" placeholder="パスワードを確認">
        <div class="spacer"></div>
        <button id="resetButton" class="action-button">パスワードを変更</button>
    </div>

    <script src="script.js"></script>
</body>
</html>
