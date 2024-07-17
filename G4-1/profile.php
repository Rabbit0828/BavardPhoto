<?php 
session_start(); 
require 'dbconnect.php';
require '../HeaderFile/header.php';

$my_id = isset($_SESSION['UserTable']['id']) ? $_SESSION['UserTable']['id'] : 0;
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($user_id == 0) {
    echo 'ユーザーIDが無効です。';
    exit;
}

if ($my_id == $user_id) {
    header('Location: ../G4-2/myprofile.php');
    exit;
}

try {
    $user_sql = 'SELECT * FROM UserTable WHERE user_id = :user_id';
    $user_stmt = $pdo->prepare($user_sql);
    $user_stmt->execute([':user_id' => $user_id]);
    $user = $user_stmt->fetch();

    if ($user) {
        require 'count.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhoto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="profile_name"><?php echo htmlspecialchars($user['user_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
    <div class="profile_head_text">
        <div class="profile_head_icon"><span><img src="../images/<?php echo htmlspecialchars($user['icon'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></span></div>
        <div class="profile_head_count">
            <span>投稿</span>
            <?php echo htmlspecialchars($post_count ?? '', ENT_QUOTES, 'UTF-8'); ?> <!-- 投稿数 -->
        </div>
        <div class="profile_head_count">
            <a href="ff.php?user_id=<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>&type=followers">
                <span>フォロワー</span>
                <span><?php echo htmlspecialchars($follower_count ?? '', ENT_QUOTES, 'UTF-8'); ?></span> <!-- フォロワー数 -->
            </a>
        </div>
        <div class="profile_head_count">
            <a href="ff.php?user_id=<?php echo htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'); ?>&type=following">
                <span>フォロー中</span>
                <span><?php echo htmlspecialchars($following_count ?? '', ENT_QUOTES, 'UTF-8'); ?></span> <!-- フォロー数 -->
            </a>
        </div>
        <div class="private-name"><?php echo htmlspecialchars($user['private_name'] ?? '', ENT_QUOTES, 'UTF-8'); ?></div>
        <div class="profile_actions">
            <?php
            $sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE user_id = :user_id AND follow_id = :my_id';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':my_id' => $my_id, ':user_id' => $user_id]);
            $isFollowing = $stmt->fetchColumn();

            if ($isFollowing) {
                echo '<div class="follow"><a href="follow_delete.php?id=', htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'), '">フォロー中</a></div>';
            } else {
                echo '<div class="not_follow"><a href="follow.php?id=', htmlspecialchars($user_id, ENT_QUOTES, 'UTF-8'), '">フォロー</a></div>';
            }
            ?>
            
        </div>
    </div>

    <!-- ここに「続きを読む」機能を追加 -->
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
    $post_stmt->execute([':user_id' => $user_id]);
    $posts = $post_stmt->fetchAll();

    if ($posts) {
        echo '<div class="post">';
        foreach ($posts as $post) {
            echo '<a href="../G2-1/G2-1-1.php?image_id=', htmlspecialchars($post['image_id'] ?? '', ENT_QUOTES, 'UTF-8'), '">';
            echo '<img src="../images/', htmlspecialchars($post['image_name'] ?? '', ENT_QUOTES, 'UTF-8'), '">';
            echo '</a>';
        }
        echo '</div>';
    } else {
        echo '<div class="center-image">';
                echo '<img src="../images/Null.png" alt="Null Image">';
                echo '</div>';
    }
    ?>
    <div id="modal" class="modal">
        <span class="close" id="close">&times;</span>
        <img class="modal-content" id="modal-image">
    </div>
    <script src="js/script.js"></script>
</body>
</html>
<?php
    } else {
        echo 'ユーザーが見つかりません。';
    }
} catch (PDOException $e) {
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
?>
