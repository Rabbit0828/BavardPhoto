<!-- ログイン画面 -->
<?php require 'header.php'; ?>
<?php require 'db-connect.php'; ?> 

<div class = "logo">
    <img src="logo.png" >
</div>

<form action="G2-1.php" method="post">

    <div class = "box">
        <P><input type="text" name="user_id" placeholder="ユーザーネーム、メールまたは携帯電話でログイン"></p>
        <P><input type="text" name="password" placeholder="パスワードを入力"></p>
        <P><button type="submit">ログイン</button></P>
    </div>

</form>

<a href="G1-2-1.phpbutton type="submit">新しいアカウントを作成</button></a>

<?php require 'footer.php'; ?>