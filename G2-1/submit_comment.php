<?php
session_start();
require 'db-connect.php';

header('Content-Type: application/json');

$response = [];

if (!isset($_SESSION['UserTable'])) {
    $response['success'] = false;
    $response['error'] = 'ユーザー情報が見つかりません。ログインしてください。';
    echo json_encode($response);
    exit;
}

$user_id = $_SESSION['UserTable']['id'];
$comment = $_POST['comment'];
$image_id = $_POST['image_id'];

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO Comment (image_id, user_id, comment) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$image_id, $user_id, $comment]);

    $response['success'] = true;
    $response['user_name'] = $_SESSION['UserTable']['name'];
    $response['user_icon'] = $_SESSION['UserTable']['icon']; // ここでアイコンもセッションに保存している場合
    $response['comment'] = htmlspecialchars($comment);

    echo json_encode($response);
} catch (PDOException $e) {
    $response['success'] = false;
    $response['error'] = $e->getMessage();
    echo json_encode($response);
}
?>
