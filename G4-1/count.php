<?php
    $post_count_sql = 'SELECT COUNT(*) FROM Post WHERE user_id = :user_id';
    $post_count_stmt = $pdo->prepare($post_count_sql);
    $post_count_stmt->execute([':user_id' => $user_id]);
    $post_count = $post_count_stmt->fetchColumn();

   //フォロりれに自分のidがいくつあるか
    $follower_count_sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE user_id = :user_id';
    $follower_count_stmt = $pdo->prepare($follower_count_sql);
    
    $follower_count_stmt->execute([':user_id' => $user_id]);
    //フォロワーの数とる
    $follower_count = $follower_count_stmt->fetchColumn();

    $following_count_sql = 'SELECT COUNT(*) FROM FollowRelationship WHERE follow_id = :user_id';
    $following_count_stmt = $pdo->prepare($following_count_sql);
    $following_count_stmt->execute([':user_id' => $user_id]);
    $following_count = $following_count_stmt->fetchColumn();
?>