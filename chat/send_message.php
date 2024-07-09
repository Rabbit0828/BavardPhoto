<?php
session_start();

// データベース接続情報
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER ='LAA1517469';
const PASS ='Pass1234';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // メッセージデータの取得
    $message = $_POST['message'];
    $sender_id = $_SESSION['UserTable']['id']; // セッションから送信者のIDを取得

    try {
        // データベースに接続
        $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // メッセージの挿入クエリの準備と実行
        $stmt = $pdo->prepare('INSERT INTO ChatMessage (sender_id, message, sent_at) VALUES (?, ?, NOW())');
        $stmt->execute([$sender_id, $message]);
        
        // 成功メッセージの出力（オプション）
        echo 'メッセージを送信しました';
    } catch(PDOException $e) {
        // エラーメッセージの出力
        echo 'エラー: ' . $e->getMessage();
    }
}
?>
