<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST['usernameOrEmail'];

    // データベース接続
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続確認
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // アカウント検索処理
    $sql = "SELECT * FROM users WHERE email='$usernameOrEmail' OR username='$usernameOrEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "アカウントが見つかりました。";
    } else {
        $message = "アカウントが見つかりませんでした。";
    }

    $conn->close();

    // 結果を表示するためにリダイレクト
    header("Location: result.php?message=" . urlencode($message));
    exit();
}
?>
