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
    $user_id = $_GET['id'];

    $pdo = new PDO($connect, user, pass);
    $sql = $pdo->prepare('select * from UserTable where user_id = ?');
    $sql->execute([$_GET['id']]);
    foreach ($sql as $row) {
        echo '<div class="user-name">', $row['user_name'],'</div>';
        echo '<div class="profile-image"><img src="', $row['icon'], '"></div>';
        
        echo '<div class="follow"><a href=followyou.php>フォロー</a></div>';
        echo '<div class="message"><a href=message.php>メッセージ</a></div>';
        echo '<div class="private-name">', $row['private_name'],'</div>';
        echo '<div class="vio">', $row['syokai'],'</div>';
        echo '<hr>';
    } 

    $post_sql = "SELECT * FROM Post WHERE user_id = :user_id";
    $post_stmt = $pdo->prepare($post_sql);
    $post_stmt->execute([':user_id' => $user_id]);
    $posts = $post_stmt->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($posts)){
        $sql = $pdo->prepare('select * from Post where user_id=?');
        $sql->execute($user_id);
        foreach ($sql as $row) {
            echo '<div class="post"><a href="post.php?id=', $id, '">', $row['image_name'], '</a></div>';
        }
    }else{
        echo '投稿がありません';
    }
    ?>
    
</body>
</html>