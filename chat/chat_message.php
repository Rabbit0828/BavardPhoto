<!-- chat_message.php -->
<?php
session_start();
require '../G4-1/dbconnect.php'; // Adjust the path as needed
try {
    $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare('SELECT * FROM ChatMessage ORDER BY sent_at DESC');
    $stmt->execute();
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div><strong>' . $row['sender_id'] . '</strong>: ' . $row['message'] . '</div>';
    }
} catch(PDOException $e) {
    echo 'エラー: ' . $e->getMessage();
}
?>
