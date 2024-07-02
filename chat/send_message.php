<?php
// データベース接続ファイルを読み込む
require './dbconnect.php';

// POSTリクエストでない場合は終了
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

// セッションを開始
session_start();

// ユーザーIDとメッセージを取得
$user_id = $_SESSION['User']['user_id'] ?? null;
$message = $_POST['message'] ?? null;

// ユーザーIDとメッセージが存在しない場合はエラーを返す
if (!$user_id || !$message) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

// メッセージをデータベースに挿入
$stmt = $pdo->prepare("INSERT INTO messages (sender_id, message) VALUES (?, ?)");
if ($stmt->execute([$user_id, $message])) {
    echo json_encode(['status' => 'success']);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
}
?>


