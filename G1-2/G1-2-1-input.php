<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>フジカワライヤーズ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="logo">
    <img src="../images/logo.png" alt="ロゴ">
</div>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'Required')">必須項目</button>
    <button class="tablinks" onclick="openTab(event, 'Optional')">その他の情報</button>
</div>

<div id="Required" class="tabcontent" style="display: block;">
    <form action="G1-2-1-output.php" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
        <div class="box">
            <div class="form-group">
                <label>必須項目：</label>
            </div>
            <div class="form-group">
                <input type="text" name="user_name" placeholder="ユーザーネームを入力" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="パスワードを入力" required>
            </div>
            <div class="form-group">
                <input type="password" name="password2" placeholder="確認用パスワード" required>
            </div>
            <div class="form-group">
                <input type="email" name="mail_address" placeholder="メールアドレスを入力" required>
            </div>
            <div class="form-group">
                <input type="tel" name="tell" placeholder="電話番号を入力" required>
            </div>
        </div>

        <div class="box2">
            <button type="submit">登録</button>
        </div>
    
</div>

<div id="Optional" class="tabcontent">
        <div class="box">
            <div class="form-group">
                <label>その他の情報（任意）：</label>
            </div>
            <div class="form-group">
                <img id="icon-preview" class="icon-preview" style="display: none;">
                <label for="icon-input" class="icon-label">アイコンを選択</label>
                <input type="file" name="icon" id="icon-input">
            </div>
            <div class="form-group">
                <input type="text" name="private_name" placeholder="名前を入力">
            </div>
            <div class="form-group">
                <input type="text" name="post_code" placeholder="〒">
            </div>
            <div class="form-group">
                <input type="text" name="address" placeholder="住所を入力">
            </div>
        </div>

        <div class="box2">
            <button type="submit">登録</button>
        </div>
        
    </form>
</div>

<script>
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

document.getElementById("icon-input").addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imgElement = document.getElementById('icon-preview');
            imgElement.src = e.target.result;
            imgElement.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

function validateForm() {
    var requiredInputs = document.querySelectorAll('#Required input[required]');
    var optionalInputs = document.querySelectorAll('#Optional input');

    for (var i = 0; i < requiredInputs.length; i++) {
        if (!requiredInputs[i].value) {
            alert("すべての必須項目を入力してください。");
            return false;
        }
    }

    var optionalFilled = false;
    for (var i = 0; i < optionalInputs.length; i++) {
        if (optionalInputs[i].value) {
            optionalFilled = true;
            break;
        }
    }

    if (!optionalFilled) {
        if (confirm("任意の項目が入力されていません。送信しますか？")) {
            document.getElementById('optional-form').submit();
        }
        return false;
    }

    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Required').style.display = 'block';
    document.getElementsByClassName('tablinks')[0].classList.add('active');
});
</script>
</body>
</html>

<style>
    body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    position: relative;
    min-height: 100vh;
    padding-bottom: 70px; /* フッタの高さ分だけ余白を追加 */
}

.logo {
    display: flex;
    justify-content: center;
    margin-bottom: 12vh;
}

.tab {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.tab button {
    background-color: #f1f1f1;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

.tab button:hover {
    background-color: #ddd;
}

.tab button.active {
    background-color: #DC34E0;
    color: white;
}

.tabcontent {
    display: none;
    padding: 6px 12px;
    border-top: none;
}

.box {
    display: flex;
    flex-direction: column;
    justify-content: center; 
    align-items: center;         
    margin-bottom: 30px;
}

.form-group {
    width: 70%;
    display: flex;
    flex-direction: column;
    align-items: center; /* アイコンを中央に揃える */
    margin-bottom: 10px;
}

.form-group label {
    margin-bottom: 5px;
    font-weight: bold;
    color: #a0a0a0;
    text-align: left;
    width: 100%; /* ラベルを幅いっぱいにして左揃えにする */
}

.box input[type="text"], .box input[type="mail"] {
    width: 100%;
    height: 50px;
    padding: 10px;
    box-sizing: border-box;
    border: 2px solid #DC34E0;
    border-radius: 10px;
}

/* アイコンを丸表示するためのCSS */
.icon-input {
    display: none; /* アイコンのファイル入力を隠す */
}

.icon-label {
    display: inline-block;
    padding: 10px 0px;
    background-color: #DC34E0;
    color: #ffffff;
    border-radius: 10px;
    cursor: pointer;
    margin-top: 10px;
}

.icon-preview {
    width: 200px;
    height: 200px;
    border-radius: 50%; /* 丸くする */
    object-fit: cover; /* アスペクト比を維持しつつ要素をカバー */
    border: 2px solid #DC34E0; /* アイコンの周りにボーダーを追加 */
    margin-bottom: 10px; /* プレビュー画像とラベルの間にマージンを追加 */
}

.box2 {
    display: flex;
    justify-content: center; 
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
