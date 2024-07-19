<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhoto</title>
    <?php require '../HeaderFile/header.php'?>
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

        // ユーザー名の表示
        if ($user) {
            echo '<div class="profile_name">', htmlspecialchars($user['user_name'] ?? ''), '</div>';
        } else {
            echo '<div class="profile_name">ユーザーが見つかりません。</div>';
        }

        // フォローフォロワー切り替えリンク
        echo '<div class="ff-switch">';
        echo '<a href="ff.php?user_id=', $user_id, '&type=followers">フォロワー</a> | ';
        echo '<a href="ff.php?user_id=', $user_id, '&type=following">フォロー</a>';
        echo '</div>';

        // フォローとフォロワーのリストを表示
        if ($type == 'following') {
            echo '<h2 class="center-text">フォロー中</h2>';
            $sql = 'SELECT UserTable.* FROM FollowRelationship 
                    JOIN UserTable ON FollowRelationship.user_id = UserTable.user_id 
                    WHERE FollowRelationship.follow_id = :user_id';
        } else {
            echo '<h2 class="center-text">フォロワー</h2>';
            $sql = 'SELECT UserTable.* FROM FollowRelationship 
                    JOIN UserTable ON FollowRelationship.follow_id = UserTable.user_id 
                    WHERE FollowRelationship.user_id = :user_id';
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        $users = $stmt->fetchAll();

        if ($users) {
            echo '<ul class="user-list">';
            foreach ($users as $user) {
                echo '<li>';
                echo '<a href="../G4-1/profile.php?id=',$user['user_id'],'"><img src="../images/', htmlspecialchars($user['icon'] ?? 'default-icon.png'), '" alt="プロフィール写真">', htmlspecialchars($user['user_name'] ?? ''), '</a>';
                    // チャットリンクを追加 (フォロー中のみ)
                    echo '<div class="chat-button">';
                    echo '<a href="../chat/chat.php?user_id=', $user['user_id'], '">チャット</a>';
                    echo '</div>';

                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo 'ユーザーが見つかりません。';
        }
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    }
    ?>
</body>
</html>
