<?php
session_start();
require 'dbconnect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームからデータを取得
    $user_name = !empty($_POST['user_name']) ? $_POST['user_name'] : $_SESSION['UserTable']['user_name'];
    $name = !empty($_POST['name']) ? $_POST['name'] : $_SESSION['UserTable']['private_name'];
    $syoukai = !empty($_POST['syoukai']) ? $_POST['syoukai'] : $_SESSION['UserTable']['syoukai'];

    // 現在のユーザーIDをセッションから取得
    $user_id = $_SESSION['UserTable']['id'];

    // プロフィール画像のアップロード処理
    $profile_image = $_FILES['profile_image'];
    $uploadDir = '../images/';
    $newFileName = $_SESSION['UserTable']['icon']; // デフォルトは既存のファイル名

    if ($profile_image['size'] > 0) {
        $fileTmpPath = $profile_image['tmp_name'];
        $fileNameCmps = explode(".", $profile_image['name']);
        $fileExtension = strtolower(end($fileNameCmps));
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // 重複しない一意のファイル名を生成
            do {
                $newFileName = uniqid() . '.' . $fileExtension;
                $dest_path = $uploadDir . $newFileName;
            } while (file_exists($dest_path));

            if (!move_uploaded_file($fileTmpPath, $dest_path)) {
                echo "ファイルのアップロードに失敗しました。";
                exit();
            }
        } else {
            echo "アップロードできるファイル形式は: " . implode(',', $allowedfileExtensions) . "です。";
            exit();
        }
    }

    // 更新クエリの準備
    $update_sql = $pdo->prepare("UPDATE UserTable SET user_name = ?, private_name = ?, syoukai = ?, icon = ? WHERE user_id = ?");
    $update_sql->execute([$user_name, $name, $syoukai, $newFileName, $user_id]);

    $select_sql = $pdo->prepare("SELECT * FROM UserTable WHERE user_id = ?");
    $select_sql->execute([$user_id]);
    $row = $select_sql->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['UserTable'] = [
            'id' => $row['user_id'],
            'user_name' => $row['user_name'],
            'private_name' => $row['private_name'],
            'syoukai' => $row['syoukai'],
            'icon' => $row['icon']
        ];
        header('Location: myprofile.php');
        exit();
    } else {
        echo "変更後のデータが見つかりませんでした<br>";
    }
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
}
?>

