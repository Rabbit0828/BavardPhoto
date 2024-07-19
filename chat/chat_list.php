<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhoto</title>
    <?php require '../HeaderFile/header.php'?>
    <link rel="stylesheet" href="css/chat_list.css">
</head>
<body>
    <?php require './G4-2/dbconnect.php'; ?>
    <?php 
    try {
        // すべてのユーザーを取得
        $sql = 'SELECT * FROM UserTable';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();

        // ユーザー名の表示
        echo '<h2>ユーザー一覧</h2>';

        if ($users) {
            echo '<ul class="user-list">';
            foreach ($users as $user) {
                echo '<li>';
                echo '<a href="../G4-1/profile.php?id=',$user['user_id'],'"><img src="../images/', htmlspecialchars($user['icon'] ?? 'default-icon.png'), '" alt="プロフィール写真">', htmlspecialchars($user['user_name'] ?? ''), '</a>';
                
                // チャットリンクを追加
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
