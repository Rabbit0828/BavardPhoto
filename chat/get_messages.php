<?php
// データベース接続ファイルを読み込む
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
$stmt = $pdo->prepare("SELECT sender_id, message FROM messages");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ユーザー名を取得するための関数
function getUserName($pdo, $userId) {
    $stmt = $pdo->prepare('SELECT user_name FROM UserTable WHERE user_id = ?');
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? $user['user_name'] : 'Unknown User';
}

// メッセージ送信者のユーザー名を含めて返す
$result = [];
foreach ($messages as $msg) {
    $userName = ($msg['sender_id'] == $user_id) ? 'あなた' : getUserName($pdo, $msg['sender_id']);
    $result[] = [
        'user' => $userName,
        'message' => $msg['message']
    ];
}

// メッセージをJSON形式で返す
echo json_encode($result);
?>
