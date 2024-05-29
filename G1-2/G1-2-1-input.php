<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>フジカワライヤーズ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="logo">
    <img src="../images/logo.png">
</div>
<?php session_start();

$name=$pass=$mail=$tell=$pass2='';
if(isset($_SESSION['UserTable'])) {
    $name=$_SESSION['UserTable']['user_name'];
    $pass=$_SESSION['UserTable']['password'];
    $mail=$_SESSION['UserTable']['mail_address'];
    $tell=$_SESSION['UserTable']['tell'];
}

echo '<form action="G1-2-2-input.php" method="post">';
echo '<div class="box">';
echo '<div class="form-group"><label>必須項目：</label></div>';
echo '<div class="form-group"><input type="text" name="user_name" value="', $name ,'" placeholder="ユーザーネームを入力"></div>';
echo '<div class="form-group"><input type="password" name="password" value="', $pass ,'" placeholder="パスワードを入力"></div>';
echo '<div class="form-group"><input type="password" name="password2" value="', $pass2 ,'" placeholder="確認用パスワードを入力"></div>';
echo '<div class="form-group"><input type="email" name="mail_address" value="', $mail ,'" placeholder="メールアドレス"></div>';
echo '<div class="form-group"><input type="text" name="tell" value="', $tell ,'" placeholder="電話番号を入力"></div>';
echo '</div>';
echo '<button type="submit">次へ</button>';
echo '</form>';
?>

</body>
</html>

<?php
 $pdo = null;   //DB切断
 ?>

<style>
.logo {
    display: flex;
    justify-content: center;
    margin-bottom: 15vh;
}

.box {
    display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center;         
    margin-bottom: 50px;
}

.box2 {
    display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center; 
    margin-bottom: 50px;
}

.form-group {
    width: 70%;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 10px;
    
}

.form-group label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #a0a0a0;
}

.box input {
    width: 100%;
    height: 50px;
    padding: 10px;
    box-sizing: border-box;
    border: 2px solid #DC34E0;
    border-radius: 10px;
}

button {
    width: 70%;
    height: 50px;
    padding: 10px;
    box-sizing: border-box;
    background-color: #DC34E0;
    color: #ffffff;
    border-radius: 10px;
    border: 0px;
    margin-top: 20px; /* ボタンを下側に配置するためにマージンを追加 */
}
</style>
