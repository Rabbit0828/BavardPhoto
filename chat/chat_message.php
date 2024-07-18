<?php
session_start();

if (!isset($_SESSION['UserTable']['id'])) {
    echo 'エラー: セッションが有効ではありません。ログインしてください。';
    exit;
}

const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

$sender_id = $_SESSION['UserTable']['id'];
$recipient_id = isset($_GET['user_id']) ? $_GET['user_id'] : '';

try {
    $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare('SELECT cm.message_id, cm.message, cm.sent_at, ut.user_name 
                           FROM ChatMessage cm
                           INNER JOIN UserTable ut ON cm.sender_id = ut.user_id
                           WHERE (cm.sender_id = :sender_id AND cm.recipient_id = :recipient_id)
                              OR (cm.sender_id = :recipient_id AND cm.recipient_id = :sender_id)
                           ORDER BY cm.sent_at ASC');
    $stmt->execute(['sender_id' => $sender_id, 'recipient_id' => $recipient_id]);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div><strong>' . htmlspecialchars($row['user_name']) . '</strong> (' . $row['sent_at'] . '): ' . htmlspecialchars($row['message']) . '</div>';
    }
} catch (PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}
?>
