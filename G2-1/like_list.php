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
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            margin: 100px;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #333;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%; /* 丸形にするための設定 */
            margin-right: 10px;
            border: 2px solid #ccc; /* ボーダーを追加 */
        }

        .user-name {
            font-size: 18px;
            color: #555;
        }
        .back-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 100px;
        }
    </style>
    <title>いいねしたユーザー</title>
</head>
<body>
<div class="container">
<?php
try {
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // GETパラメータからimage_idを取得
    if (isset($_GET['id'])) {
        $image_id = intval($_GET['id']);

        // Niceテーブルからいいねをしたユーザー名とアイコンを取得
        $liked_users_sql = "SELECT UserTable.user_id, UserTable.user_name, UserTable.icon
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
                echo '<li>';
                if (isset($liked_user['user_id'])) {
                    echo '<img src="../images/' . htmlspecialchars($liked_user['icon']) . '" alt="ユーザーアイコン" class="user-icon">';
                    echo '<span class="user-name"><a href="../G4-1/profile.php?id=' . htmlspecialchars($liked_user['user_id']) . '">' . htmlspecialchars($liked_user['user_name']) . '</a></span>';
                } else {
                    echo '<span class="user-name">ユーザー情報がありません</span>';
                }
                echo '</li>';
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
</div>
<img src="../images/back_page.png" alt="Image" onclick="goBack()" style="width:100px" />

<script>
function goBack() {
    window.history.back();
}
</script>

</body>
</html>