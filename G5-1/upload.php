<?php
session_start();

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

// セッションからユーザーIDを取得
if (!isset($_SESSION['UserTable']['id'])) {
    die("ユーザーがログインしていません。");
}
$user_id = $_SESSION['UserTable']['id'];

// アップロードされたファイルが存在するか確認
// アップロードされたファイルが存在するか確認
if (!empty($_FILES['files']['name'][0]) && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    
    // アップロードされたファイル数の取得
    $fileCount = count($_FILES['files']['name']);
    
    // データベースに画像情報を挿入するための準備
    $stmt = $pdo->prepare("INSERT INTO Post (user_id, image_name, comment) VALUES (:user_id, :image_name, :comment)");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':image_name', $image_name);

    // 画像のアップロード処理をループで行う
    for ($i = 0; $i < $fileCount; $i++) {
        $file = $_FILES['files'];
        $fileExtension = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
        $randomNumber = rand(1000, 9999);
        $newFileName = uniqid('img_', true) . '_' . $randomNumber . '.' . $fileExtension;
        $uploadFile = $uploadDir . $newFileName;

        // 画像ファイルかどうか確認
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($file['type'][$i], $allowedTypes)) {
            // ファイルを移動
            if (move_uploaded_file($file['tmp_name'][$i], $uploadFile)) {
                // データベースに情報を挿入
                $stmt->execute();
            } else {
                echo "ファイルのアップロードに失敗しました。";
            }
        } else {
            echo "無効なファイル形式です。";
        }
    }

    echo "<h2>投稿が完了しました</h2>";
    echo "<a href="../G2-1/G2-1.php">ホームに戻る</a>";
} else {
    echo "ファイルまたはコメントが選択されていません。";
}

?>