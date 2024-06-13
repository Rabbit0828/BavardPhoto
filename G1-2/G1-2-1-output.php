<?php
session_start();

// セッション変数をリセット
unset($_SESSION['UserTable']);

// データベース接続
$dsn = 'mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1517469-photos;charset=utf8';
$username = 'LAA1517469';
$password = 'Pass1234';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // 入力データをサニタイズする
        function customSanitize($string) {
            // HTMLタグを除去し、両端の空白をトリムする
            return trim(strip_tags($string));
        }

        $user_name = isset($_POST['user_name']) ? customSanitize($_POST['user_name']) : '';
        $password = isset($_POST['password']) ? customSanitize($_POST['password']) : '';
        $password2 = isset($_POST['password2']) ? customSanitize($_POST['password2']) : '';
        $mail_address = isset($_POST['mail_address']) ? filter_var($_POST['mail_address'], FILTER_SANITIZE_EMAIL) : '';
        $private_name = isset($_POST['private_name']) ? customSanitize($_POST['private_name']) : '';
        $tell = isset($_POST['tell']) ? customSanitize($_POST['tell']) : '';
        $post_code = isset($_POST['post_code']) ? customSanitize($_POST['post_code']) : '';
        $address = isset($_POST['address']) ? customSanitize($_POST['address']) : '';
        $icon = isset($_POST['icon']) ? customSanitize($_POST['icon']) : '';
    
         // ファイルアップロード処理
         if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../images/'; // アップロード先のディレクトリ
            if (!is_dir($upload_dir)) {
                // ディレクトリが存在しない場合は作成する
                mkdir($upload_dir, 0755, true);
            }
            
            // Generate a unique file name
            $file_ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
            $unique_name = uniqid() . '.' . $file_ext;
            
            if (move_uploaded_file($_FILES['icon']['tmp_name'], $upload_dir . $unique_name)) {
                // ファイルの移動が成功した場合
                $icon = $unique_name;
                echo "ファイルのアップロードに成功しました。";
            } else {
                // ファイルの移動が失敗した場合
                echo "ファイルのアップロードに失敗しました。";
            }
        }

        if (!isset($user_name) || !isset($password) || !isset($password2) || !isset($mail_address) || !isset($tell) ||
        $user_name === '' || $password === '' || $password2 === '' || $mail_address === '' || $tell === '') {
            echo "すべての必須項目を入力してください。";
        } elseif ($password !== $password2) {
            echo "パスワードが一致しません。";
        } else {
            // ユーザー名の重複確認
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM UserTable WHERE user_name = :user_name');
            $stmt->bindParam(':user_name', $user_name);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo "ユーザー名は既に使用されています。";
            } else {
                
                // 新しいユーザーを挿入
                $stmt = $pdo->prepare('INSERT INTO UserTable (user_name, password, mail_address, private_name, tell, post_code, address, icon) VALUES (:user_name, :password, :mail_address, :private_name, :tell, :post_code, :address, :icon)');
                $stmt->bindParam(':user_name', $user_name);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':mail_address', $mail_address);
                $stmt->bindParam(':private_name', $private_name);
                $stmt->bindParam(':tell', $tell);
                $stmt->bindParam(':post_code', $post_code);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':icon', $icon);

                $stmt->execute();
                header('Location: ../G1-3/G1-3.php');
                exit();
            }
        }
    }
} catch (PDOException $e) {
    echo '接続に失敗しました: ' . $e->getMessage();
}

$pdo = null; // DB切断
?>


