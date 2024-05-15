<!-- 新規登録画面 -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>フジカワライヤーズ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class = "logo">
    <img src="logo.png" >
</div>

<form action="G1-2-2.php" method="post">

    <div class = "box">
        <p>必須項目：</p>
        <P><input type="text" name="user_id" placeholder="ユーザーネームを入力"></p>
        <P><input type="text" name="password" placeholder="パスワードを入力"></p>
        <P><input type="text" name="user_id" placeholder="確認用パスワードを入力"></p>
        <P><input type="email" name="password" placeholder="メールアドレス"></p>
        <p><input type="text" name="" id=""></p>
        <P><button type="submit">次へ</button></P>
    </div>

</form>

<a href="G1-2-1.phpbutton type="submit">新しいアカウントを作成</button></a>

</body>
</html>

<?php
 $pdo = null;   //DB切断
 ?>