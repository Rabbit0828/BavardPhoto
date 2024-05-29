<?php
require 'db.php';

if (isset($_POST['search'])) {
    $usernameOrEmail = $_POST['usernameOrEmail'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
    $stmt->execute(['email' => $usernameOrEmail, 'username' => $usernameOrEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        header('Location: index.html?reset=true&user=' . urlencode($usernameOrEmail));
        exit();
    } else {
        echo "<p>アカウントが見つかりませんでした。</p>";
    }
} else {
    header('Location: index.html');
    exit();
}
?>
