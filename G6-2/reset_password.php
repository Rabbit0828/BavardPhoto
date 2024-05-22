<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['newPassword'];

    // パスワードのバリデーション
    if (strlen($newPassword) >= 8) {
        // パスワードのハッシュ化
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // データベース接続
      $servername = "mysql304.phy.lolipop.lan";
    $username = "LAA1517469";
    $password = "Pass1234";
    $dbname = "LAA1517469-photos";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // 接続確認
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // パスワード更新処理（仮のユーザーIDとして1を使用）
        $sql = "UPDATE users SET password='$hashedPassword' WHERE id=1";

        if ($conn->query($sql) === TRUE) {
            $message = "パスワードが更新されました。";
        } else {
            $message = "エラー: " . $conn->error;
        }

        $conn->close();
    } else {
        $message = "パスワードは8文字以上でなければなりません。";
    }

    // 結果を表示するためにリダイレクト
    header("Location: result.php?message=" . urlencode($message));
    exit();
}
?>
