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
    $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;
    $type = isset($_GET['type']) ? $_GET['type'] : 'followers';

    if ($user_id == 0) {
        echo 'ユーザーIDが無効です。';
        exit;
    }

    try {
        // ユーザー情報を取得
        $user_sql = 'SELECT * FROM FollowRelationship WHERE user_id = :user_id';
        $user_stmt = $pdo->prepare($user_sql);
        $user_stmt->execute([':user_id' => $user_id]);
        $user = $user_stmt->fetch();

        if ($user) {
            echo '<div class="profile_name">', htmlspecialchars($user['user_name'] ?? ''), '</div>';

            // フォローとフォロワーの切り替えリンク
            echo '<div class="ff-switch">';
            echo '<a href="ff.php?user_id=', $user_id, '&type=followers">フォロワー</a> | ';
            echo '<a href="ff.php?user_id=', $user_id, '&type=following">フォロー</a>';
            echo '</div>';

            // フォローとフォロワーのリストを表示
            if ($type == 'following') {
                $sql = 'SELECT UserTable.* FROM FollowRelationship 
                        JOIN UserTable ON FollowRelationship.follow_id = UserTable.user_id 
                        WHERE FollowRelationship.user_id = :user_id';
                echo '<h2>フォロー中</h2>';
            } else {
                $sql = 'SELECT UserTable.* FROM FollowRelationship 
                        JOIN UserTable ON FollowRelationship.user_id = UserTable.user_id 
                        WHERE FollowRelationship.follow_id = :user_id';
                echo '<h2>フォロワー</h2>';
            }

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':user_id' => $user_id]);
            $users = $stmt->fetchAll();

            if ($users) {
                echo '<ul class="user-list">';
                foreach ($users as $user) {
                    echo '<li><a href="profile.php?id=',$user['user_id'],'"><img src="', htmlspecialchars($user['icon'] ?? 'default-icon.png'), '" alt="プロフィール写真">', htmlspecialchars($user['user_name'] ?? ''), '</a></li>';
                }
                echo '</ul>';
            } else {
                echo 'ユーザーが見つかりません。';
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
