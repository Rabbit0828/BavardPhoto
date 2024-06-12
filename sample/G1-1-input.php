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
    <p><img src="../images/logo.png" style="height:70px; width:200px;"></p>
</div>

<form action="G1-1-output.php" method="post">
    <div class = "box">
        <input type="text" name="user_id"  placeholder="ユーザーネーム、メールまたは携帯電話でログイン">
        <input type="text" name="password" placeholder="パスワードを入力">
        <button type="submit">ログイン</button>
    </div>
</form>

<form action="../G1-2/G1-2-1-input.php" method="post">
    <div class = "box2">
        <button type="submit" id="button">新しいアカウントを作成</button>
    </div>
</form>


</body>
</html>

<?php
 $pdo = null;   //DB切断
 ?>


<!-- css -->
<style>

    .logo {
        display: flex;
        justify-content: center; /* 水平方向の中央配置 */
        /* align-items: center; 垂直方向の中央配置 */
        
    }

    .box {
        display: flex;
        flex-direction: column;
        justify-content: center; 
        align-items: center; 
        height: 60vh;
        margin-bottom: 50px;
    }

    .box input, .box button {
        margin-bottom: 10px; /* Adjust the value as needed for desired spacing */
    }
    
    .box input:last-child, .box button {
        margin-bottom: 0; /* Ensure no extra space after the last element */
    }

    .box input {
    width: 70%; /* テキストボックスの横幅 */
    height: 50px; /* テキストボックスの立幅 */
    padding: 10px; /* テキストボックスの左側のスペース */
    box-sizing: border-box; /* Ensure padding and border are included in the element's total width and height */
    border: 2px solid #DC34E0; /* テキストボックスの枠線の太さ・色 */
    border-radius: 10px; /* テキストボックスの角を丸くする corner radius */
        
    }

    .box2 {
    position: fixed;
    bottom: 0;
    width: 100%;
    display: flex;
    justify-content: center; 
    align-items: center; 
    padding: 50px 0; /* 上下にパディングを追加 */
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