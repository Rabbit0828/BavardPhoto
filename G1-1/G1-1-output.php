<?php
session_start();

unset($_SESSION['UserTable']);
$pdo = new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1517469-photos;charset=utf8', 'LAA1517469', 'Pass1234');
$sql = $pdo->prepare('select * from UserTable where user_name=? or mail_address=? or tell=?');
$sql->execute([$_POST['user_id'], $_POST['user_id'], $_POST['user_id']]);
$row = $sql->fetch();

if ($row && $_POST['password'] === $row['password']) {
    $_SESSION['UserTable'] = [
        'id' => $row['user_id'],
        'name' => $row['user_name'],
        'password' => $row['password'], // 修正: 'password'を'user_pass'に変更
        'name2' => $row['private_name'],
        'address' => $row['address'],
        'telephone' => $row['tell'],
        'mail_address' => $row['mail_address'], // 修正: 'address'を'mail_address'に変更
        'icon' => $row['icon']
    ];

    header('Location: ../G2-1/G2-1.php');
    exit;
} else {
    $_SESSION['login_error'] = "メールアドレスまたはパスワードが違います。<br>
                                ログイン画面に戻ります。";
    echo '<script>
            setTimeout(function() {
                window.location.href = "../G1-1/G1-1-input.php";
            }, 2000);
        </script>';
}

if (isset($_SESSION['login_error'])) {
    echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']); 
}

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
