<?php
session_start();

// データベース接続情報
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

try {
    $pdo = new PDO("mysql:host=" . SERVER . ";dbname=" . DBNAME . ";charset=utf8", USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続に失敗しました: " . $e->getMessage());
}

// セッションからユーザーIDを取得
if (!isset($_SESSION['UserTable']['id'])) {
    die("ユーザーがログインしていません。");
}
$userId = $_SESSION['UserTable']['id'];

// POSTリクエストから受信者のユーザーIDを取得
if (isset($_POST['receiver_id'])) {
    $receiverId = intval($_POST['receiver_id']);

    // チャットメッセージをデータベースから取得
    $sql = "SELECT * FROM ChatMessages WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id) ORDER BY sent_at ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sender_id' => $userId, ':receiver_id' => $receiverId]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // メッセージをJSON形式で返す
    header('Content-Type: application/json');
    echo json_encode($messages);
} else {
    // エラーを返す
    http_response_code(400);
    echo "受信者のユーザーIDが指定されていません。";
}
?>