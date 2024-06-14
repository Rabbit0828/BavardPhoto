<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // ここにメッセージを取得する処理を追加（例：データベースから取得）
    $messages = []; // 例: $messages = $db->query("SELECT user, message FROM messages")->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($messages);
}
?>

