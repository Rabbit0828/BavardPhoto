<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // セッション変数を全て解除する
    $_SESSION = [];

    // セッションを削除する
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // セッションを破棄する
    session_destroy();

    // HTMLとJavaScriptで画像を表示し、数秒後にリダイレクト
    echo '<!DOCTYPE html>
    <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログアウト</title>
        <style>
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                font-family: Arial, sans-serif;
            }
            img {
                width: 200px; /* Adjust the size as needed */
                height: auto;
            }
        </style>
    </head>
    <body>
        <img src="../images/bye.png" alt="ロゴ">
        <p>ログアウトしました。ログインページに移動します。</p>
        <script>
            // 3秒後にリダイレクト
            setTimeout(function() {
                window.location.href = "../G1-1/G1-1-input.php";
            }, 1500);
        </script>
    </body>
    </html>';
    exit();
}
?>
