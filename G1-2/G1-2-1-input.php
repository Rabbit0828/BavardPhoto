<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フジカワライヤーズ</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 0;
            background-color: #f0f0f0;/* ! */
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);/* ! */
            max-width: 830px;
            width: 100%;
            text-align: center;
            box-sizing: border-box;
            margin-top: 20px;
        }

        /* .form-group {
            margin-bottom: 15px;
            text-align: left;
        } */

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        input[type="file"] {
            display: none;
        }

        .tab {
            text-align: center;
            margin-bottom: 20px;
        }

        .tab button {
            background-color: #DC34E0;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .tab button.active {
            background-color: #bc2abe;
        }

        .tabcontent {
            display: none;
            /* padding: 20px;
            background-color: #bc2abe;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); */
        }

        .container .logo {
            margin-bottom: 50px;
        }

        .container .input-box {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #fff;
        }
        .container button {
            width: 100%;
            padding: 10px;
            background-color: #DC34E0;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 10px;
        }

    
        .container button:hover {
            background-color: #b02db3;
        }

        .container .register-button {
            background-color: white;
            color: #DC34E0;
            border: 1px solid #DC34E0;
        }
        .register-button:hover {
            background-color: #f4e1f8;
            color: #b02db3;
        }

        @media (max-width: 800px) {
            .container {
                padding: 20px;
            }
            .container h2 {
                font-size: 20px;
            }
            button {
                font-size: 14px;
                padding: 8px;
            }
        }
        @media (max-width: 500px) {
            .container {
                padding: 10px;
            }
            .container h2 {
                font-size: 18px;
            }
            button {
                font-size: 12px;
                padding: 6px;
            }
        }

        .input-box {
            width: calc(100% - 20px);
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .box,
        .box2 {
            margin-bottom: 20px;
        }

        .box2 button {
            background-color: #DC34E0;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .box2 button:hover {
            background-color: #b02db3;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

    </style>

</head>
<body>



<div class="container">
<div class="logo">
    <img src="../images/logo.png" alt="ロゴ">
</div>
    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Required')">必須項目</button>
        <button class="tablinks" onclick="openTab(event, 'Optional')">その他の情報</button>
    </div>

    <div id="Required" class="tabcontent">
        <form action="G1-2-1-output.php" method="post" onsubmit="return validateForm();">
            <div class="box">
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
        </form>
    </div>


    <div id="Optional" class="tabcontent">
        <form id="optional-form" action="G1-2-2-output.php" method="post">
            <div class="box">
                <!-- <div class="form-group">
                    <label>アイコン選択：</label>
                    <img id="icon-preview" class="icon-preview" style="display: none;">
                    <input type="file" name="icon" class="icon-input" id="icon-input">
                    <label for="icon-input" class="icon-label">アイコンを選択</label>
                </div> -->
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

