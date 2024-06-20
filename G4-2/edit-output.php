<?php
session_start();
require 'dbconnect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // フォームからデータを取得
    $user_name = $_POST['user_name'];
    $name = $_POST['name'];
    $syoukai = $_POST['syoukai'];

    // 現在のユーザーIDをセッションから取得
    $user_id = $_SESSION['UserTable']['id'];

    // 更新クエリの準備
    $update_sql = $pdo->prepare("UPDATE UserTable SET user_name = ?, private_name = ?, syoukai = ? WHERE user_id = ?");
    $update_sql->execute([$user_name, $name, $syoukai, $user_id]);

    $select_sql = $pdo->prepare("SELECT * FROM UserTable WHERE user_id = ?");
    $select_sql->execute([$user_id]);
    $row = $select_sql->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['UserTable'] = [
            'id' => $row['user_id'],
            'user_name' => $row['user_name'],
            'private_name' => $row['private_name'],
            'syoukai' => $row['syoukai']
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