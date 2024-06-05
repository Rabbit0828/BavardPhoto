<?php session_start()?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>フォロー画面</title>
        <link rel="stylesheet" href="css/follow.css">
    </head>
    <body> 
        <?php require 'dbconnect.php';?>
        <?php  
            $pdo=new PDO($connect,USER,PASS);  
            foreach($pdo->query('select * from FollowRelationship') as $row){
            echo '<div class="stats">';
                $follower_count_sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE follow_id = :follow_id';
                $follower_count_stmt = $pdo->prepare($follower_count_sql);
                $follower_id=$row['follow_id'];
                $follower_count_stmt->execute(['follow_id' => $follower_id]);
                $follower_count = $follower_count_stmt->fetchColumn();
            echo '<div class="followers">',$follower_count,'フォロワー</div>';
            $user_count_sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE user_id = :user_id';
            $user_count_stmt = $pdo->prepare($user_count_sql);
            $user_id=$row['user_id'];
            $user_count_stmt->execute(['user_id' => $user_id]);
            $user_count = $user_count_stmt->fetchColumn();
            echo '<div class="following">',$user_count,'フォロー中</div>';
        }      
        ?>
        <?php
                echo '<form action="http://aso2201143.zombie.jp/BavardPhoto/G4-2/follow.php" method="get">';
                echo '<input type="search" name="search" placeholder="キーワードを入力">';
                echo '<button type="submit" name="submit" value="検索">';
               echo '</form>';
        ?>
    <?php
    try{
    $pdo=new PDO($connect,USER,PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query('SELECT UserTable.user_name, UserTable.private_name FROM UserTable 
                         JOIN FollowRelationship ON UserTable.user_id = FollowRelationship.follow_id');
        foreach($stmt as $row){
        echo '<div class="list">';
        echo '<div class="list-item">';
        echo '<div class="profile-info">';
        echo '<div class="name">',htmlspecialchars($row['user_name']),'</div>';
        echo '<div class="details">',htmlspecialchars($row['private_name']),'</div>';
        echo '</div>';
        echo '<div class="follow-button"></div>';
        echo '</div>';
        echo '</div>';
        }
    }catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>
    </body>
</html>