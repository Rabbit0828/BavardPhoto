<?php
// dbconnect.phpを読み込む
require './dbconnect.php';

// セッションを開始
session_start();

// ユーザーIDを取得
$user_id = $_SESSION['User']['user_id'] ?? null;

// ユーザーIDが存在しない場合はエラーを返す
if (!$user_id) {
    http_response_code(400);
    exit;
}

// メッセージをデータベースから取得
$stmt = $pdo->prepare("SELECT * FROM messages");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// メッセージをJSON形式で返す
echo json_encode($messages);
?>
