<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usernameOrEmail = $_POST['usernameOrEmail'];

    $servername = "mysql304.phy.lolipop.lan";
    $username = "LAA1517469";
    $password = "Pass1234";
    $dbname = "LAA1517469-photos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 接続確認
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM users WHERE email='$usernameOrEmail' OR username='$usernameOrEmail'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $message = "アカウントが見つかりました。";
    } else {
        $message = "アカウントが見つかりませんでした。";
    }

    $conn->close();

    header("Location: result.php?message=" . urlencode($message));
    exit();
}
?>
