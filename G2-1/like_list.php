<?php
session_start();
require 'db-connect.php';
require '../HeaderFile/header.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="G2-1.css">
    <title>いいねしたユーザー</title>
</head>
<body>
<?php
try {
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // GETパラメータからimage_idを取得
    if (isset($_GET['id'])) {
        $image_id = intval($_GET['id']);

        // Niceテーブルからいいねをしたユーザー名を取得
        $liked_users_sql = "SELECT UserTable.user_name
                            FROM Nice
                            JOIN UserTable ON Nice.user_id = UserTable.user_id
                            WHERE Nice.image_id = :image_id";
        $liked_users_stmt = $pdo->prepare($liked_users_sql);
        $liked_users_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $liked_users_stmt->execute();
        $liked_users = $liked_users_stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($liked_users) {
            echo "<h2>この投稿にいいねしたユーザー:</h2>";
            echo "<ul>";
            foreach ($liked_users as $liked_user) {
                echo "<li>" . htmlspecialchars($liked_user['user_name']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>この投稿にいいねしたユーザーはいません。</p>";
        }
    } else {
        echo "<p>投稿が指定されていません。</p>";
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
</body>
</html>
