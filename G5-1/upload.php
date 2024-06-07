<?php
session_start();
require 'dbconnect.php'; // データベース接続ファイル

// フォームが送信されたか確認
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file']) && isset($_POST['description'])) {
    $uploadDir = 'uploads/'; // アップロードディレクトリを指定
    $uploadFile = $uploadDir . basename($_FILES['file']['name']);
    $description = $_POST['description'];

    // ディレクトリが存在しない場合は作成
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // ファイルタイプの確認 (画像のみ許可)
    $fileType = pathinfo($uploadFile, PATHINFO_EXTENSION);
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        echo "このファイルタイプは許可されていません。";
        exit;
    }

    // ファイルをサーバーに保存
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        // データベースにファイルパスと説明文を保存
        try {
            $stmt = $pdo->prepare('INSERT INTO story (image, description) VALUES (:image, :description)');
            $stmt->bindParam(':image', $uploadFile, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();
            echo "ファイルと説明文が正常にアップロードされ、データベースに保存されました: " . htmlspecialchars(basename($_FILES['file']['name']));
        } catch (PDOException $e) {
            echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "ファイルアップロード中にエラーが発生しました。サーバーに保存できませんでした。";
    }
} else {
    echo "ファイルまたは説明文が送信されていません。";
}
?>
