<?php
include 'db.php';

try {
    $stmt = $pdo->query("SELECT username, message, timestamp FROM messages ORDER BY timestamp DESC");
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($messages);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
