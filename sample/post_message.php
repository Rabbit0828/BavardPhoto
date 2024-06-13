<?php
include 'db.php';

$username = $_POST['username'];
$message = $_POST['message'];

$stmt = $pdo->prepare('INSERT INTO messages (username, message) VALUES (?, ?)');
$stmt->execute([$username, $message]);

echo json_encode(['status' => 'success']);
?>
