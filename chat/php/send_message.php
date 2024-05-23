<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $message = $_POST['message'];

    try {
        $stmt = $pdo->prepare("INSERT INTO messages (username, message) VALUES (?, ?)");
        $stmt->execute([$username, $message]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
