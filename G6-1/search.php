<?php
require 'db.php';

header('Content-Type: application/json');

$response = ['success' => false];

if (isset($_POST['usernameOrEmail'])) {
    $usernameOrEmail = $_POST['usernameOrEmail'];

    // クエリを準備して実行
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
    $stmt->execute(['email' => $usernameOrEmail, 'username' => $usernameOrEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $response['success'] = true;
    }
}

echo json_encode($response);
?>
