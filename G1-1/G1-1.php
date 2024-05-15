<!-- ログイン画面 -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>フジカワライヤーズ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class = "logo">
    <img src="../images/logo.png" >
</div>

<form action="G2-1.php" method="post">

    <div class = "box">
        <P><input type="text" name="user_id" placeholder="ユーザーネーム、メールまたは携帯電話でログイン"></p>
        <P><input type="text" name="password" placeholder="パスワードを入力"></p>
        <P><button type="submit">ログイン</button></P>
    </div>

</form>

<a href="G1-2-1.phpbutton type="submit">新しいアカウントを作成</button></a>

</body>
</html>

<?php
 $pdo = null;   //DB切断
 ?>