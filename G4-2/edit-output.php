<?php
session_start();
require 'dbconnect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームからデータを取得
    $name = !empty($_POST['name']) ? $_POST['name'] : $_SESSION['UserTable']['private_name'];
    $syoukai = !empty($_POST['syoukai']) ? $_POST['syoukai'] : $_SESSION['UserTable']['syoukai'];

    // 現在のユーザーIDをセッションから取得
    $user_id = $_SESSION['UserTable']['id'];

    // デフォルトのファイル名を設定
    $newFileName = isset($_SESSION['UserTable']['icon']) ? $_SESSION['UserTable']['icon'] : 'guest.png';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        // プロフィール画像のアップロード処理
        $profile_image = $_FILES['profile_image'];
        $uploadDir = '../images/';

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
                    showErrorAndRedirect("ファイルのアップロードに失敗しました。");
                }
            } else {
                showErrorAndRedirect("アップロードできるファイル形式は: " . implode(',', $allowedfileExtensions) . "です。");
            }
        }
    }

    // 更新クエリの準備
    $update_sql = $pdo->prepare("UPDATE UserTable SET private_name = ?, syoukai = ?, icon = ? WHERE user_id = ?");
    $update_sql->execute([$name, $syoukai, $newFileName, $user_id]);

    // ユーザー情報を更新してセッションに再設定
    // $select_sql = $pdo->prepare("SELECT * FROM UserTable WHERE user_id = ?");
    // $select_sql->execute([$user_id]);
    // $row = $select_sql->fetch(PDO::FETCH_ASSOC);

    // if ($row) {
    //    header('Location: myprofile.php');
    //    exit();
    // } else {
    //    showErrorAndRedirect("変更後のデータが見つかりませんでした");
    // }

} catch (PDOException $e) {
    showErrorAndRedirect("データベースエラー: " . $e->getMessage());
}

function showErrorAndRedirect($message) {
    echo '<div style="text-align:center;margin-top:20px;">';
    echo '<p>' . htmlspecialchars($message) . '</p>';
    echo '<p>数秒後に前の画面に戻ります...</p>';
    echo '</div>';
    echo '<script>
            setTimeout(function() {
                window.history.back();
            }, 3000);
          </script>';
    exit();
}
?>
