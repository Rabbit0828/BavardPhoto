<?php
session_start();

unset($_SESSION['UserTable']);

$dsn = 'mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1517469-photos;charset=utf8';
$username = 'LAA1517469';
$password = 'Pass1234';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        function customSanitize($string) {
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
        
        $icon = 'guest.png';

        if ($user_name === '' || $password === '' || $password2 === '' || $mail_address === '' || $tell === '') {
            $_SESSION['login_error'] = "すべての必須項目を入力してください。<br>
                                        新規登録画面に戻ります。";
        } elseif ($password !== $password2) {
            $_SESSION['login_error'] = "パスワードが一致しません。<br>
                                        新規登録画面に戻ります。";
            echo '<script>
                  setTimeout(function() {
                  window.location.href = "../G1-2/G1-2-1-input.php";
                  }, 2000);
        </script>';
        } else {
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM UserTable WHERE user_name = :user_name');
            $stmt->bindParam(':user_name', $user_name);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                $_SESSION['login_error'] = "ユーザー名は既に使用されています。<br>
                                            新規登録画面に戻ります。";
                echo '<script>
                  setTimeout(function() {
                  window.location.href = "../G1-2/G1-2-1-input.php";
                  }, 2000);
        </script>';
            } else {
                $pdo->beginTransaction();
                try {
                    $stmt = $pdo->prepare('INSERT INTO UserTable (user_name, password, mail_address, private_name, tell, post_code, address, icon) VALUES (:user_name, :password, :mail_address, :private_name, :tell, :post_code, :address, :icon)');
                    $stmt->bindParam(':user_name', $user_name);
                    $stmt->bindParam(':password', $password); // パスワードをハッシュ化せずに保存
                    $stmt->bindParam(':mail_address', $mail_address);
                    $stmt->bindParam(':private_name', $private_name);
                    $stmt->bindParam(':tell', $tell);
                    $stmt->bindParam(':post_code', $post_code);
                    $stmt->bindParam(':address', $address);
                    $stmt->bindParam(':icon', $icon);
                    
                    $stmt->execute();

                    // Followテーブルにユーザー名を追加
                    $stmt = $pdo->prepare('INSERT INTO Follow (user_name) VALUES (:user_name)');
                    $stmt->bindParam(':user_name', $user_name);
                    $stmt->execute();

                    $pdo->commit();
                    header('Location: ../G1-3/G1-3.php');
                    exit();
                } catch (Exception $e) {
                    $pdo->rollBack();
                    throw $e;
                }
            }
        }
    }
} catch (PDOException $e) {
    echo '接続に失敗しました: ' . $e->getMessage();
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Error</title>
    <style>
        .error {
            color: red;
            font-size: 24px; /* Increase the font size */
            text-align: center; /* Center the text */
            margin-top: 20%; /* Center vertically */
        }
    </style>
</head>
<body>
    <div class="error-container">
        <?php
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>
    </div>
</body>
</html>
