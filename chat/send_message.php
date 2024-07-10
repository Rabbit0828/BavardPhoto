<?php
session_start();

const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $sender_id = $_SESSION['UserTable']['id'];
    $recipient_id=$_GET['user_id'];

    try {
        $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO ChatMessage (sender_id, recipient_id, message, sent_at) VALUES (?, ?, ?, NOW())');
        $stmt->execute([$sender_id,$recipient_id,$message]);

        echo 'メッセージを送信しました';
    } catch (PDOException $e) {
        echo 'エラー: ' . $e->getMessage();
    }
}
?>

