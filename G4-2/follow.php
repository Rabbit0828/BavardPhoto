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
                $follower_count_sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE user_id = :user_id';
                $follower_count_stmt = $pdo->prepare($follower_count_sql);
                $user_id=$row['user_id'];
                $follower_count_stmt->execute(['user_id' => $user_id]);
                $follower_count = $follower_count_stmt->fetchColumn();
            echo '<div class="stats">';
            echo '<div class="followers">',$follower_count,'フォロワー</div>';
            echo '<div class="following">フォロー中</div>';
        }
        ?>

     <input id="box2" name="s" type="text" placeholder="キーワードを入力" />
        <button id="btn2" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
    <div class="list">
    <div class="list-item">
    <div class="profile-info">
    <div class="name">aiueo</div>
    <div class="details">あいうえお</div>
    </div>
    <div class="follow-button">フォロー中</div>
    </div>
    <!-- Repeat the .list-item block as needed -->
    </div>
 
    </body>
</html>