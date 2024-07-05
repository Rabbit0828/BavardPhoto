<?php
session_start();
require '../G4-1/dbconnect.php'; // Adjust the path as needed

$current_user_id = $_SESSION['id'];
$chat_user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = 'SELECT * FROM ChatMessage WHERE (sender_id = :current_user_id AND recipient_id = :chat_user_id)
        OR (sender_id = :chat_user_id AND recipient_id = :current_user_id) ORDER BY sent_at ASC';
$stmt = $pdo->prepare($sql);
$stmt->execute([':current_user_id' => $current_user_id, ':chat_user_id' => $chat_user_id]);
$messages = $stmt->fetchAll();

foreach ($messages as $message) {
    $sender = $message['sender_id'] == $current_user_id ? 'You' : htmlspecialchars($chat_user['user_name']);
    echo '<div><strong>' . $sender . ':</strong> ' . htmlspecialchars($message['message']) . '</div>';
}

?>
