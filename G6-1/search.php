<?php
require 'db.php';

header('Content-Type: application/json');

$response = ['success' => false];

if (isset($_POST['usernameOrEmail'])) {
    $usernameOrEmail = $_POST['usernameOrEmail'];

    // クエリを準備して実行
    $stmt = $pdo->prepare("SELECT * FROM UserTable WHERE mail_address = :mail_address OR user_name = :user_name");
    $stmt->execute(['mail_address' => $usernameOrEmail, 'user_name' => $usernameOrEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $response['success'] = true;
    }
}

echo json_encode($response);
?>
