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
$data = json_decode(file_get_contents('php://input'), true);
$image_id = $data['image_id'];

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the user has already liked the post
    $check_sql = "SELECT COUNT(*) FROM Nice WHERE image_id = ? AND user_id = ?";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->execute([$image_id, $user_id]);
    $already_liked = $check_stmt->fetchColumn();

    if ($already_liked) {
        // User has already liked the post, delete the like
        $delete_sql = "DELETE FROM Nice WHERE image_id = ? AND user_id = ?";
        $delete_stmt = $pdo->prepare($delete_sql);
        $delete_stmt->execute([$image_id, $user_id]);

        $response['success'] = true;
        $response['like_count'] = updateLikeCount($pdo, $image_id); // Update like count
    } else {
        // User has not liked the post, insert new like
        $insert_sql = "INSERT INTO Nice (image_id, user_id) VALUES (?, ?)";
        $insert_stmt = $pdo->prepare($insert_sql);
        $insert_stmt->execute([$image_id, $user_id]);

        $response['success'] = true;
        $response['like_count'] = updateLikeCount($pdo, $image_id); // Update like count
    }

    echo json_encode($response);
} catch (PDOException $e) {
    $response['success'] = false;
    $response['error'] = 'Database error: ' . $e->getMessage();
    echo json_encode($response);
}

// Function to update like count for a given image_id
function updateLikeCount($pdo, $image_id) {
    $like_count_sql = "SELECT COUNT(*) AS like_count FROM Nice WHERE image_id = ?";
    $like_count_stmt = $pdo->prepare($like_count_sql);
    $like_count_stmt->execute([$image_id]);
    return $like_count_stmt->fetch(PDO::FETCH_ASSOC)['like_count'];
}
?>
