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

    if(){}
    $sql = $pdo->prepare('select * from Post where user_id=?');
    $sql->execute([$_GET['id']]);
</body>
</html>