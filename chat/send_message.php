<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = $_POST['message'];
    // ここにデータベース保存処理を追加
    echo json_encode(['status' => 'success']);
}
?>
