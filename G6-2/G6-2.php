<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="G6-2.css">
</head>
<body>
    <h1>パスワード変更</h1>
    <p>新しいパスワードを入力してください。</p>
    <input type="password" id="newPassword" class="input-box" placeholder="">
    <div class="spacer"></div>
    <button id="resetButton" class="action-button">完了</button>

    <div id="accountSearchContainer" style="display: none;">
        <h1>アカウントを検索</h1>
        <p>メールアドレスまたはユーザーネームを入力してください。</p>
        <input type="text" id="usernameOrEmail" class="input-box" placeholder="メールアドレスまたはユーザーネーム">
        <div class="spacer"></div>
        <button id="nextButton" class="action-button">次へ</button>
    </div>

    <script src="script.js"></script>
</body>
</html>
