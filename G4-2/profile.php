<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhotos</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require 'dbconnect.php'; ?>
    <?php 
    $my_id = isset($_SESSION['User']['user_id']) ? $_SESSION['User']['user_id'] : 0;
    $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($user_id == 0) {
        echo 'ユーザーIDが無効です。';
        exit;
    }

    try {
        $user_sql = 'SELECT * FROM UserTable WHERE user_id = :user_id';
        $user_stmt = $pdo->prepare($user_sql);
        $user_stmt->execute([':user_id' => $user_id]);
        $user = $user_stmt->fetch();

        if ($user) {
            echo '<div class="user-name">', htmlspecialchars($user['user_name']), '</div>';
            echo '<div class="profile-image"><img src="', htmlspecialchars($user['icon']), '"></div>';
            echo '<div class="follow"><a href="followyou.php">フォロー</a></div>';
            echo '<div class="message"><a href="message.php">メッセージ</a></div>';
            echo '<div class="private-name">', htmlspecialchars($user['private_name']), '</div>';
            echo '<div class="vio">', htmlspecialchars($user['syoukai']), '</div>';
            echo '<hr>';

            $post_sql = 'SELECT * FROM Post WHERE user_id = :user_id';
            $post_stmt = $pdo->prepare($post_sql);
            $post_stmt->execute([':user_id' => $user_id]);
            $posts = $post_stmt->fetchAll();

            if ($posts) {
                foreach ($posts as $post) {
                    echo '<div class="post"><a href="post.php?id=', htmlspecialchars($post['id']), '">', htmlspecialchars($post['image_name']), '</a></div>';
                }
            } else {
                echo '投稿がありません';
            }
        } else {
            echo 'ユーザーが見つかりません。';
        }
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    }
    ?>
</body>
</html>
