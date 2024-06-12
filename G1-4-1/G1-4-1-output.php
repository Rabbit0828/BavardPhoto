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

    // ログアウト後のリダイレクト
    header('Location: ../G1-1/G1-1-input.php');
    exit();
}
?>
