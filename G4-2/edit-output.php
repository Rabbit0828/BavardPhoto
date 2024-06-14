<?php 
session_start();
require 'dbconnect.php'; 

unset($_SESSION['UserTable']);

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $pdo->prepare("SELECT * FROM UserTable WHERE user_name = ? OR private_name = ? OR syoukai = ?");
    $sql->execute([$_POST['user_name'], $_POST['name'], $_POST['syoukai']]);

    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['UserTable'] = [
            'id' => $row['user_id'],
            'user_name' => $row['user_name'],
            'password' => $row['password'], 
            'name' => $row['private_name'],
            'address' => $row['address'],
            'telephone' => $row['tell'],
            'mail_address' => $row['mail_address'] 
        ];
        header('Location: myprofile.php');
        exit();
    } else {
        // データが見つからなかった場合の処理
        echo "ユーザーが見つかりません。";
    }
} catch (PDOException $e) {
    echo "データベースエラー: " . $e->getMessage();
}
?>