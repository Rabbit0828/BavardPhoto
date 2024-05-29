<?php
session_start();

require 'dbconnect.php';

// GET パラメータからフォロー解除対象のユーザーIDを取得
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ユーザーIDが有効かどうかを確認
if ($user_id == 0) {
    echo 'ユーザーIDが無効です。';
    exit;
}

// ログインしているユーザーのIDを取得
$my_id = isset($_SESSION['User']['user_id']) ? $_SESSION['User']['user_id'] : 0;

try {
    // FollowRelationship テーブルからレコードを削除
    $delete_sql = 'DELETE FROM FollowRelationship WHERE user_id = :user_id AND follow_id = :my_id';
    $delete_stmt = $pdo->prepare($delete_sql);
    $delete_stmt->execute([':my_id' => $my_id, ':user_id' => $user_id]);

    // 元のページにリダイレクト
    header('Location: profile.php?id=' . $user_id);
    exit;

} catch (PDOException $e) {
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
}
?>
