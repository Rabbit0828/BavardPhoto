<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhotos</title>
    <link rel="stylesheet" href="css/myprofile.css">
</head>
<body>
    <?php require 'dbconnect.php'; ?>
    <?php require '../HeaderFile/header_mypage.php'?>
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

            echo '<div class="profile_name">', htmlspecialchars($user['user_name'] ?? ''), '</div>';
            echo '<div class="profile_head_text">';
            echo '<div class="profile_head_icon"><span><img src="../images/', htmlspecialchars($user['icon'] ?? ''), '"></span></div>';
            echo '<div class="profile_head_count">';
            echo '<span>投稿</span>';
            echo htmlspecialchars($post_count); //投稿数
            echo '</div>';
            echo '<div class="profile_head_count">';
            echo '<span>フォロワー</span>';
            echo '<a href="ff.php?user_id=', $my_id, '&type=followers">',htmlspecialchars($follower_count),'</a>'; //フォロワー数
            echo '</div>';
            echo '<div class="profile_head_count">';
            echo '<span>フォロー中</span>';
            echo '<a href="ff.php?user_id=', $my_id, '&type=following">',htmlspecialchars($following_count),'</a>'; //フォロー数
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

            // ここに「続きを読む」機能を追加
            echo '<div class="vio">';
            echo '<div class="text-content-wrapper">';
            echo '<p class="text-content" id="text">', htmlspecialchars($user['syoukai'] ?? ''), '</p>';
            echo '<button id="read-more">続きを読む</button>';
            echo '</div>';
            echo '</div>';
            echo '<hr>';

            $post_sql = 'SELECT * FROM Post WHERE user_id = :user_id';
            $post_stmt = $pdo->prepare($post_sql);
            $post_stmt->execute([':user_id' => $my_id]);
            $posts = $post_stmt->fetchAll();

            if ($posts) {
                echo '<div class="post">';
                foreach ($posts as $post) {
                    echo '<a href="#" class="post-link" data-image-id="', htmlspecialchars($post['image_id'] ?? ''), '">';
                    echo '<img src="../images/', htmlspecialchars($post['image_name'] ?? ''), '">';
                    echo '</a>';
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

    <div id="modal" class="modal">
        <span class="close" id="close">&times;</span>
        <img class="modal-content" id="modal-image">
    </div>

    <script src="js/script.js"></script>
</body>
</html>

<!--<!DOCTYPE html>
<link rel="stylesheet" href="css/myprofile.css">
<html>
    <head>
        <meta charset="UTF-8">
        <title>myprofile</title>
    </head>
    <body>
        <div class="profile_name">
            miyamiya0316
        </div>
        <div class="profile_head">
            <div class="profile_head_icon">
                <img src="img/my.jpg">
            </div>
            <div class="profile_head_text">
                <div class="profile_head_count">-->
                    <!----データベースつなげる----->
                    <!--3
                    <span>投稿</span>
                </div>
                <div class="profile_head_count">
                    <a href="follow.php">-->
                    <!--〃-->
                    <!--700,000
                    <span>フォロワー</span>
                </a>
                </div>
                <div class="profile_head_count">
                    <a href="follow.php">-->
                    <!--〃-->
                    <!--600
                    <span>フォロー中</span>
                </a>
                </div>
            </div>
        </div>
        <div class="profile_body">
            <div class="profile_body_text">-->
                    <!--〃-->
                    <!--<p class="name">宮本 悠（20歳）</p>
            <p class="introduction">
                インスタグラムはじめました 麻生情報ビジネス専門学校
                情報システム専攻科 出会いを求めています jiijijjijijjiji
            </p>
            </div>
            <div class="profile_body_edit">
                <a href="edit.html">プロフィールを編集</a>
            </div>
        </div>
            <hr>
        <div class="post">
            <article>
                <a href="toukou.html"><img src="img/toukou.jpg"></a>
            </article>
            <article>
                <a href="toukou.html"><img src="img/toukou.jpg"></a>
            </article>
            <article>
                <a href="toukou.html"><img src="img/toukou.jpg"></a>
            </article>
            <article>
                <a href="toukou.html"><img src="img/toukou.jpg"></a>
            </article>
        </div>
    </body>
</html>-->