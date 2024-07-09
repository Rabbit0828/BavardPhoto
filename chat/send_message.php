<!-- send_message.php -->
<?php
session_start();
require '../G4-1/dbconnect.php'; // Adjust the path as needed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'];
    $sender_id = $_SESSION['UserTable']['id']; // セッションが既に開始されていることを想定
    
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->prepare('INSERT INTO ChatMessage (sender_id, message, sent_at) VALUES (?, ?, NOW())');
        $stmt->execute([$sender_id, $message]);
        
        // オプション: 成功メッセージや状態を返す場合
        echo 'メッセージを送信しました';
    } catch(PDOException $e) {
        echo 'エラー: ' . $e->getMessage();
    }
}
?>


