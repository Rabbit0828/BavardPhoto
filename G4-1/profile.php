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

    echo 'IDが',$_SESSION['User']['user_id'],'の',$my_id,'でログイン中';
    echo 'IDが',intval($_GET['id']),'の',$user_id,'の画面を見ています';

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
            require 'count.php';

            echo '<div class="profile_name">', htmlspecialchars($user['user_name'] ?? ''), '</div>';
            echo '<div class="profile_head_text">';
            echo '<div class="profile_head_icon"><span><img src="', htmlspecialchars($user['icon'] ?? ''), '"></span></div>';
            echo '<div class="profile_head_count">';
            echo '<span>投稿</span>';
            echo htmlspecialchars($post_count); //投稿数
            echo '</div>';
            echo '<div class="profile_head_count">';
            echo '<span>フォロワー</span>';
            echo htmlspecialchars($follower_count); //フォロワー数
            echo '</div>';
            echo '<div class="profile_head_count">';
            echo '<span>フォロー中</span>';
            echo htmlspecialchars($following_count); //フォロー数
            echo '</div>';
            echo '<div class="private-name">', htmlspecialchars($user['private_name'] ?? ''), '</div>';
            echo '<div class="profile_actions">';
            $sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE user_id = :user_id AND follow_id = :my_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':my_id' => $my_id, ':user_id' => $user_id]);
            $isFollowing = $stmt->fetchColumn();

            if ($isFollowing) {
                echo '<div class="follow"><a href=follow_delete.php?=',$user_id,'>フォロー中</div>';
            } else {
                echo '<div class="not_follow"><a href=follow.php?id=',$user_id,'>フォロー</div>';
            }
            echo '<div class="message"><a href="">メッセージ</a></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="vio">', htmlspecialchars($user['syoukai'] ?? ''), '</div>';
            echo '<hr>';

            $post_sql = 'SELECT * FROM Post WHERE user_id = :user_id';
            $post_stmt = $pdo->prepare($post_sql);
            $post_stmt->execute([':user_id' => $user_id]);
            $posts = $post_stmt->fetchAll();

            if ($posts) {
                echo '<div class="post">';
                foreach ($posts as $post) {
                    echo '<a href="post.php?id=', htmlspecialchars($post['image_id'] ?? ''), '"><img src="', htmlspecialchars($post['image_name'] ?? ''), '"></a>';
                }
                echo '</div>';
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
