<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhotos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .centered-container {
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .home-link {
            color: black;
            text-decoration: underline;
        }
    </style>
</head>
<body>
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

// セッションからユーザーIDを取得
if (!isset($_SESSION['UserTable']['id'])) {
    die("ユーザーがログインしていません。");
}
$user_id = $_SESSION['UserTable']['id'];

// アップロードされたファイルが存在するか確認
if (isset($_FILES['files']) && isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    
    // アップロード先のディレクトリ
    $uploadDir = '../images/';

    // アップロードされたファイル数の取得
    $fileCount = count($_FILES['files']['name']);

    // 画像のアップロード処理をループで行う
    for ($i = 0; $i < $fileCount; $i++) {
        $file = $_FILES['files'];
        
        // エラーチェック
        if ($file['error'][$i] === UPLOAD_ERR_OK) {
            // ディレクトリが存在しない場合は作成
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // 乱数を生成してファイル名に追加
            $fileExtension = pathinfo($file['name'][$i], PATHINFO_EXTENSION);
            $randomNumber = rand(1000, 9999);
            $newFileName = uniqid('img_', true) . '_' . $randomNumber . '.' . $fileExtension;
            $uploadFile = $uploadDir . $newFileName;

            // 画像ファイルかどうか確認
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($file['type'][$i], $allowedTypes)) {
                // ファイルを移動
                if (move_uploaded_file($file['tmp_name'][$i], $uploadFile)) {
                    // データベースに情報を挿入または更新
                    switch ($i) {
                        case 0:
                            $stmt = $pdo->prepare("INSERT INTO Post (user_id, image_name, time, comment) VALUES (:user_id, :image_name, :time, :comment)");
                            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                            $stmt->bindParam(':image_name', $newFileName);
                            $time = date('Y-m-d H:i:s');
                            $stmt->bindParam(':time', $time);
                            $stmt->bindParam(':comment', $comment);
                            break;
                        case 1:
                            $stmt = $pdo->prepare("UPDATE Post SET image_name2 = :image_name2 WHERE user_id = :user_id");
                            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                            $stmt->bindParam(':image_name2', $newFileName);
                            break;
                        case 2:
                            $stmt = $pdo->prepare("UPDATE Post SET image_name3 = :image_name3 WHERE user_id = :user_id");
                            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                            $stmt->bindParam(':image_name3', $newFileName);
                            break;
                        case 3:
                            $stmt = $pdo->prepare("UPDATE Post SET image_name4 = :image_name4 WHERE user_id = :user_id");
                            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                            $stmt->bindParam(':image_name4', $newFileName);
                            break;
                        default:
                            continue 2; // 4枚目以降は無視する
                    }
                    
                    if (!($stmt->execute())) {
                        echo "データベースへの保存または更新に失敗しました。";
                    }
                } else {
                    echo "ファイルのアップロードに失敗しました。";
                }
            } else {
                echo "無効なファイル形式です。";
            }
        } else {
            echo "エラーが発生しました: " . $file['error'][$i];
        }
    }

    echo '<div class="centered-container">';
    echo "<h2>投稿が完了しました</h2>";
    echo '<a href="../G2-1/G2-1.php" class="home-link">ホームに戻る</a>';
    echo '</div>';

} else {
    echo "ファイルまたはコメントが選択されていません。";
}
?>

</body>
</html>
