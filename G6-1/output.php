<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

try {
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続失敗: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['search'])) {
        $usernameOrEmail = $_POST['usernameOrEmail'];

        $stmt = $pdo->prepare("SELECT * FROM UserTable WHERE mail_address = :mail_address OR user_name = :user_name");
        $stmt->execute(['mail_address' => $usernameOrEmail, 'user_name' => $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo '<!DOCTYPE html>
            <html lang="ja">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>パスワード再設定</title>
                <link rel="stylesheet" href="G6-1.css">
            </head>
            <body>
                <div class="container" id="passwordResetContainer">
                    <h1>パスワードを再設定</h1>
                    <p>新しいパスワードを入力してください。</p>
                    <form method="POST" action="output.php">
                        <input type="hidden" name="usernameOrEmail" value="' . htmlspecialchars($usernameOrEmail) . '">
                        <input type="password" name="newPassword" class="input-box" placeholder="新しいパスワード" required>
                        <div class="spacer"></div>
                        <input type="password" name="confirmPassword" class="input-box" placeholder="パスワードを確認" required>
                        <div class="spacer"></div>
                        <button type="submit" name="reset" class="action-button">パスワードを変更</button>
                    </form>
                </div>
            </body>
            </html>';
        } else {
            echo '<!DOCTYPE html>
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
                    <p style="color: red;">アカウントが見つかりませんでした。</p>
                </div>
            </body>
            </html>';
        }
    } elseif (isset($_POST['reset'])) {
        $usernameOrEmail = $_POST['usernameOrEmail'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($newPassword === $confirmPassword) {
            $stmt = $pdo->prepare("UPDATE UserTable SET password = :password WHERE mail_address = :mail_address OR user_name = :user_name");
            $stmt->execute([
                'password' => $newPassword,
                'mail_address' => $usernameOrEmail,
                'user_name' => $usernameOrEmail
            ]);

            echo '<!DOCTYPE html>
            <html lang="ja">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>パスワード再設定完了</title>
                <link rel="stylesheet" href="G6-1.css">
            </head>
            <body>


            <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sparkleCount = 100; // キラキラの数
            const body = document.body;

            for (let i = 0; i < sparkleCount; i++) {
                const sparkle = document.createElement("div");
                sparkle.className = "sparkle";
                sparkle.style.left = `${Math.random() * 100}vw`;
                sparkle.style.top = `${Math.random() * 100}vh`;
                sparkle.style.animationDelay = `${Math.random() * 2}s`;
                body.appendChild(sparkle);
            }
        });
    </script>


            
            <div class="container">
            <h2>パスワード再設定完了</h2>
                <div class="login">
                    <a href="../G1-1/G1-1-input.php">
                        <button type="submit">LOGIN</button>
                    </a>
                </div>
                    <p>パスワードが正常に更新されました。<br>
                    再度ログインしなおしてください。</p>
                </div>
            </body>


            </html>';
        } else {
            echo '<!DOCTYPE html>
            <html lang="ja">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>パスワード再設定</title>
                <link rel="stylesheet" href="G6-1.css">
            </head>
            <body>
                <div class="container" id="passwordResetContainer">
                    <h1>パスワードを再設定</h1>
                    <p>新しいパスワードを入力してください。</p>
                    <form method="POST" action="output.php">
                        <input type="hidden" name="usernameOrEmail" value="' . htmlspecialchars($usernameOrEmail) . '">
                        <input type="password" name="newPassword" class="input-box" placeholder="新しいパスワード" required>
                        <div class="spacer"></div>
                        <input type="password" name="confirmPassword" class="input-box" placeholder="パスワードを確認" required>
                        <div class="spacer"></div>
                        <button type="submit" name="reset" class="action-button">パスワードを変更</button>
                    </form>
                    <p style="color: red;">パスワードが一致しません。</p>
                </div>
            </body>
            </html>';
        }
    }
}
?>
