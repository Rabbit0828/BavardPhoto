<?php
session_start();
require '../G4-1/dbconnect.php'; // Adjust the path as needed

$current_user_id = $_SESSION['id'];
$chat_user_id = isset($_POST['chat_user_id']) ? intval($_POST['chat_user_id']) : 0;
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if ($chat_user_id == 0 || $message == '') {
    echo 'Invalid input.';
    exit;
}

$sql = 'INSERT INTO ChatMessage (sender_id, recipient_id, message, sent_at) VALUES (:sender_id, :recipient_id, :message, NOW())';
$stmt = $pdo->prepare($sql);
$stmt->execute([':sender_id' => $current_user_id, ':recipient_id' => $chat_user_id, ':message' => $message]);
?>

