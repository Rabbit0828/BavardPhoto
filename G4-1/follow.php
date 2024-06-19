<?php
session_start();

require 'dbconnect.php';

// GET パラメータからフォロー対象のユーザーIDを取得
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ユーザーIDが有効かどうかを確認
if ($user_id == 0) {
    echo 'ユーザーIDが無効です。';
    exit;
}

// ログインしているユーザーのIDを取得
$my_id = isset($_SESSION['UserTable']['id']) ? $_SESSION['UserTable']['id'] : 0;

if($my_id==0){
    header('Location: ../G1-1/G-1-input.php');
}

try {

    // FollowRelationship テーブルに新しいレコードを挿入
    $insert_sql = 'INSERT INTO FollowRelationship (user_id, follow_id) VALUES (:user_id, :my_id)';
    $insert_stmt = $pdo->prepare($insert_sql);
    $insert_stmt->execute([':my_id' => $my_id, ':user_id' => $user_id]);

    // 元のページにリダイレクト
    header('Location: profile.php?id=' . $user_id);
    exit;

} catch (PDOException $e) {
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
}
?>
