<?php
session_start();
require 'db-connect.php';

header('Content-Type: application/json');

// セッションから user_id を取得
if (isset($_SESSION['UserTable']['id'])) {
    $user_id = $_SESSION['UserTable']['id'];
} else {
    echo json_encode(['success' => false, 'error' => 'User not logged in.']);
    exit;
}

// JSON入力から image_id を取得
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['image_id'])) {
    $image_id = $input['image_id'];
    
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // いいねが既に存在するか確認
        $check_sql = "SELECT * FROM Nice WHERE user_id = :user_id AND image_id = :image_id";
        $check_stmt = $pdo->prepare($check_sql);
        $check_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $check_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $check_stmt->execute();
        $nice_exists = $check_stmt->fetch(PDO::FETCH_ASSOC);

        if ($nice_exists) {
            // 既にいいねしている場合は削除
            $delete_sql = "DELETE FROM Nice WHERE user_id = :user_id AND image_id = :image_id";
            $delete_stmt = $pdo->prepare($delete_sql);
            $delete_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $delete_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
            $delete_stmt->execute();
        } else {
            // いいねが存在しない場合は挿入
            $insert_sql = "INSERT INTO Nice (user_id, image_id) VALUES (:user_id, :image_id)";
            $insert_stmt = $pdo->prepare($insert_sql);
            $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $insert_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
            $insert_stmt->execute();
        }

        // 新しいいいねの数を取得
        $like_sql = "SELECT COUNT(*) AS like_count FROM Nice WHERE image_id = :image_id";
        $like_stmt = $pdo->prepare($like_sql);
        $like_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $like_stmt->execute();
        $like_count = $like_stmt->fetch(PDO::FETCH_ASSOC)['like_count'];

        echo json_encode(['success' => true, 'like_count' => $like_count]);

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid parameters.']);
}
?>
