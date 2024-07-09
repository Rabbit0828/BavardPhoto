<?php
session_start();

// データベース接続情報
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER ='LAA1517469';
const PASS ='Pass1234';

try {
    // データベースに接続
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // チャットメッセージの取得と表示
    $stmt = $pdo->prepare('SELECT cm.message_id, cm.message, cm.sent_at, ut.user_name 
                           FROM ChatMessage cm
                           INNER JOIN UserTable ut ON cm.sender_id = ut.user_id
                           ORDER BY cm.sent_at DESC');
    $stmt->execute();

    // 取得したメッセージを表示
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div><strong>' . htmlspecialchars($row['user_name']) . '</strong> (' . $row['sent_at'] . '): ' . htmlspecialchars($row['message']) . '</div>';
    }
} catch(PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}
?>

