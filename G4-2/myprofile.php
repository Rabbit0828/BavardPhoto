<?php session_start(); ?>
<?php require '../HeaderFile/header_mypage.php'?>
<?php require 'dbconnect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhotos</title>
    <link rel="icon" href="../images/BPfavicon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/myprofile.css">
    
</head>
<body>
    <?php 
    $my_id = isset($_SESSION['UserTable']['id']) ? $_SESSION['UserTable']['id'] : 0;

    if ($my_id == 0) {
        echo 'ユーザーIDが無効です。';
        exit;
    }

    try {
        $user_sql = 'SELECT * FROM UserTable WHERE user_id = :user_id';
        $user_stmt = $pdo->prepare($user_sql);
        $user_stmt->execute([':user_id' => $my_id]);
        $user = $user_stmt->fetch();

        if ($user) {
            require 'count.php';
            echo '<div class="content">';
            echo '<div class="profile_head_text">';

            echo '<div class="profile_head_icon"><span><img src="../images/',htmlspecialchars($user['icon']??''), '"></span></div>';
            echo '<div class="profile_head_count">';



            echo '<span>投稿</span>';
            echo htmlspecialchars($post_count); //投稿数
            echo '</div>';
            echo '<div class="profile_head_count">';
            echo '<span>フォロワー</span>';
            echo '<a href="./ff.php?user_id=', $my_id, '&type=followers">',htmlspecialchars($follower_count),'</a>'; //フォロワー数
            echo '</div>';
            echo '<div class="profile_head_count">';
            echo '<span>フォロー中</span>';
            echo '<a href="./ff.php?user_id=', $my_id, '&type=following">',htmlspecialchars($following_count),'</a>'; //フォロー数
            echo '</div>';
            echo '<div class="private-name">', htmlspecialchars($user['private_name'] ?? ''), '</div>';
            echo '<div class="profile_actions">';
            $sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE user_id = :user_id AND follow_id = :my_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':my_id' => $my_id, ':user_id' => $my_id]);
            $isFollowing = $stmt->fetchColumn();

            echo '<div class="profile_body_edit"><a href="edit-input.php">プロフィール編集</a></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        ?>
    <div class="vio">
        <div class="text-content-wrapper">
            <p class="text-content" id="text"><?php echo htmlspecialchars($user['syoukai'] ?? '', ENT_QUOTES, 'UTF-8'); ?></p>
            <button id="read-more" style="display:none;"></button>
        </div>
    </div>
    <hr>

        <?php
            $post_sql = 'SELECT * FROM Post WHERE user_id = :user_id';
            $post_stmt = $pdo->prepare($post_sql);
            $post_stmt->execute([':user_id' => $my_id]);
            $posts = $post_stmt->fetchAll();

            if ($posts) {
                echo '<div class="post">';
                foreach ($posts as $post) {
                    echo '<a href="../G2-1/G2-1-1.php?image_id=', htmlspecialchars($post['image_id'] ?? '', ENT_QUOTES, 'UTF-8'), '">';
                    echo '<img src="../images/', htmlspecialchars($post['image_name'] ?? ''), '">';
                    echo '</a>';
                }
                echo '</div>';
            } else {
                echo '<div class="center-image">';
                echo '<img src="../images/Null.png" alt="Null Image">';
                echo '</div>';
            }
        } else {
            echo 'ユーザーが見つかりません。';
        }
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    }
    ?>

    <div id="modal" class="modal">
        <span class="close" id="close">&times;</span>
        <img class="modal-content" id="modal-image">
    </div>

    <script src="js/script.js"></script>
</body>
</html>

