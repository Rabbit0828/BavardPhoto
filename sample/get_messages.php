<?php
include 'db.php';

$stmt = $pdo->query('SELECT * FROM messages ORDER BY created_at DESC');
$messages = $stmt->fetchAll();

echo json_encode($messages);
?>
