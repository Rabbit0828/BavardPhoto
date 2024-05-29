<?php
require 'db.php';

if (isset($_POST['reset'])) {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $usernameOrEmail = $_GET['user'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email OR username = :username");
        $stmt->execute([
            'password' => $hashedPassword,
            'email' => $usernameOrEmail,
            'username' => $usernameOrEmail
        ]);

        echo "<p>パスワードが正常にリセットされました。</p>";
    } else {
        echo "<p>パスワードが一致しません。</p>";
    }
} else {
    header('Location: index.html');
    exit();
}
?>
