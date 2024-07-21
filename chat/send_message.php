<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['UserTable']['id'])) {
    echo 'エラー: セッションが有効ではありません。ログインしてください。';
    exit;
}

const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $sender_id = $_SESSION['UserTable']['id'];
    $recipient_id = $_POST['recipient_id']; 

    try {
        $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // メッセージ送信処理
        $stmt = $pdo->prepare('INSERT INTO ChatMessage (sender_id, recipient_id, message, sent_at) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$sender_id, $recipient_id, $message]);
        // 通知登録処理
        $stmt = $pdo->prepare('INSERT INTO Notifications (user_id, sender_id) VALUES (?, ?)');
        $stmt->execute([$recipient_id, $sender_id]);

        echo 'メッセージを送信しました';
    } catch (PDOException $e) {
        echo 'エラー: ' . $e->getMessage();
    }
}
?>
