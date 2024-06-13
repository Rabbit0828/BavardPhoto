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
$senderId = $_SESSION['UserTable']['id'];

// POSTリクエストから受信者のユーザーIDとメッセージを取得
if (isset($_POST['receiver_id'], $_POST['message'])) {
    $receiverId = intval($_POST['receiver_id']);
    $message = $_POST['message'];

    // メッセージをデータベースに保存
    $sql = "INSERT INTO ChatMessages (sender_id, receiver_id, message_text) VALUES (:sender_id, :receiver_id, :message_text)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':sender_id' => $senderId, ':receiver_id' => $receiverId, ':message_text' => $message]);

    // 成功を返す
    http_response_code(200);
    echo "メッセージが送信されました。";
} else {
    // エラーを返す
    http_response_code(400);
    echo "受信者のユーザーIDとメッセージが指定されていません。";
}
?>