<?php
// データベース接続情報
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

try {
    $pdo = new PDO("mysql:host=" . SERVER . ";dbname=" . DBNAME . ";charset=utf8", USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("データベース接続に失敗しました: " . $e->getMessage());
}

// アップロードされたファイルが存在するか確認
if (isset($_FILES['file']) && isset($_POST['comment'])) {
    $file = $_FILES['file'];
    $comment = $_POST['comment'];

    // エラーチェック
    if ($file['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images'; // アップロードされたファイルの保存先ディレクトリ
        
        // ディレクトリが存在しない場合は作成
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // 乱数を生成してファイル名に追加
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $randomNumber = rand(1000, 9999);
        $newFileName = uniqid('img_', true) . '_' . $randomNumber . '.' . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;

        // 画像ファイルかどうか確認
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($file['type'], $allowedTypes)) {
            // ファイルを移動
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                // データベースに情報を挿入
                $stmt = $pdo->prepare("INSERT INTO photos (image_name, image_name2, image_name3, image_name4, time, comment) VALUES (:image_name, :image_name2, :image_name3, :image_name4, :time, :comment)");
                $stmt->bindParam(':image_name', $newFileName);
                $stmt->bindParam(':image_name2', $newFileName); // 必要に応じて変更
                $stmt->bindParam(':image_name3', $newFileName); // 必要に応じて変更
                $stmt->bindParam(':image_name4', $newFileName); // 必要に応じて変更
                $stmt->bindParam(':time', date('Y-m-d H:i:s'));
                $stmt->bindParam(':comment', $comment);
                
                if ($stmt->execute()) {
                    echo "ファイルは正常にアップロードされ、データベースに保存されました。";
                } else {
                    echo "データベースへの保存に失敗しました。";
                }
            } else {
                echo "ファイルのアップロードに失敗しました。";
            }
        } else {
            echo "無効なファイル形式です。";
        }
    } else {
        echo "エラーが発生しました: " . $file['error'];
    }
} else {
    echo "ファイルまたはコメントが選択されていません。";
}
?>

