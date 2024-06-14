<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    // ここにデータベース保存処理を追加
    // 例: $db->query("INSERT INTO messages (user, message) VALUES ('あなた', '$message')");
    echo json_encode(['status' => 'success']);
}
?>




