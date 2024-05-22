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

<form action="G1-2-2-output.php" method="post">
    <div class="box">
        <div class="form-group">
            <label>その他の情報（任意）：</label>
        </div>
        <div class="form-group">
            <input type="text" name="private_name" placeholder="名前を入力">
        </div>
        <div class="form-group">
            <input type="password" name="post_code" placeholder="〒">
        </div>
        <div class="form-group">
            <input type="password" name="address" placeholder="住所を入力">
        </div>
    </div>

    <div class = "box2">
        <button type="submit">次へ</button>
    </div>
</form>

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
