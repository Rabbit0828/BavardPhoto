<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="G6-1.css">
    <script>
        function showPasswordReset() {
            document.getElementById('searchContainer').style.display = 'none';
            document.getElementById('passwordResetContainer').style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container" id="searchContainer">
        <h1>アカウントを検索</h1>
        <p>メールアドレスまたはユーザーネームを入力してください。</p>
        <form id="searchForm" method="POST" action="search.php" onsubmit="showPasswordReset()">
            <input type="text" name="usernameOrEmail" class="input-box" placeholder="メールアドレスまたはユーザーネーム" required>
            <div class="spacer"></div>
            <button type="submit" name="search" class="action-button">次へ</button>
        </form>
    </div>

    <div class="container" id="passwordResetContainer" style="display: none;">
        <h1>パスワードを再設定</h1>
        <p>新しいパスワードを入力してください。</p>
        <form id="resetForm" method="POST" action="reset.php">
            <input type="hidden" name="usernameOrEmail" id="hiddenUsernameOrEmail">
            <input type="password" name="newPassword" class="input-box" placeholder="新しいパスワード" required>
            <div class="spacer"></div>
            <input type="password" name="confirmPassword" class="input-box" placeholder="パスワードを確認" required>
            <div class="spacer"></div>
            <button type="submit" name="reset" class="action-button">パスワードを変更</button>
        </form>
    </div>
</body>
</html>
