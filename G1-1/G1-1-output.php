<?php
session_start();

unset($_SESSION['UserTable']);
$pdo=new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1517469-photos;charset=utf8',
'LAA1517469','Pass1234');
$sql = $pdo->prepare('select * from UserTable where user_name=? or mail_address=? or tell=? ');
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
        'mail_address' => $row['mail_address'] // 修正: 'address'を'mail_address'に変更
    ];
    
    header('Location: index.php');
    exit;
} else {
    $_SESSION['login_error'] = "メールアドレスまたはパスワードが違います";
}

if (isset($_SESSION['login_error'])) {
    echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']); 
}

?>
