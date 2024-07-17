<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhotos</title>
    <?php require '../HeaderFile/header.php'; ?>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin-top: 100px; 
    }

    .upload-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 50px;
    }

    .upload-area {
        display: grid;
        grid-template-columns: 150px auto;
        grid-gap: 20px;
        align-items: center;
        margin-bottom: 10px;
    }

    .upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 150px;
        height: 150px;
        border: 2px dashed #ccc;
        border-radius: 10px;
        cursor: pointer;
        position: relative;
    }

    .upload-label::before {
        content: "+";
        font-size: 50px;
        color: #ccc;
        position: absolute;
    }

    .upload-instructions {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .upload-instructions p {
        margin: 5px 0;
        color: #666;
    }

    #file {
        display: none;
    }

    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 10px;
    }

    .preview-container img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }

    .comment-box {
        width: 300px;
        height: 100px;
        padding: 10px;
        margin-bottom: 20px;
        border: 3px solid #DC34E0;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .submit-button {
        padding: 10px 20px;
        background-color: #f0a2f2;
        color: block;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top:-10px;
    }

    .submit-button:hover {
        background-color: pink;
    }

    .login-button {
        position: absolute;
        top: 40px;
        left: 20px;
        background-color: white;
        color: black;
        padding: 10px 20px;
        border: 1.5px solid black;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .login-button:hover {
        background-color: #f4f4f4;
    }

    .error-message {
        color: red;
        margin-bottom: 10px;
    }
</style>

</head>
<body>
<form action="../G2-1/G2-1.php">
        <button type="submit" class="login-button">＜　ホーム画面<br>
        <img src="../images/deru.png" style="width:90px" alt="Comment"></button>
    </form>
    <div class="upload-container">
        <form id="upload-form" action="upload.php" method="post" enctype="multipart/form-data">
            <div class="upload-area">
                <label for="file" class="upload-label"></label>
                <div class="upload-instructions">
                    <p>画像を選択してください</p>
                    <p>画像は4枚まで選択できます</p>
                </div>
            </div>
            <input type="file" name="files[]" id="file" multiple onchange="previewFiles()">
            <div class="preview-container" id="preview-container"></div>
            
            <input type="text" name="comment" class="comment-box" placeholder="コメントを入力してください">
            <div class="error-message" id="error-message"></div>
            <button type="submit" class="submit-button">
                アップロード<br />
                <img src="../images/upload.png" alt="Upload" style="width:40px;">
            </button>
            
        </form>
    </div>

    <script>
        function previewFiles() {
            const previewContainer = document.getElementById('preview-container');
            const files = document.getElementById('file').files;
            previewContainer.innerHTML = '';

            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }

        document.getElementById('upload-form').addEventListener('submit', function(event) {
            const files = document.getElementById('file').files;
            const errorMessage = document.getElementById('error-message');

            if (files.length === 0) {
                event.preventDefault(); // フォームの送信をキャンセル
                errorMessage.textContent = '画像を最低1枚は選択してください。';
            } else {
                errorMessage.textContent = ''; // エラーメッセージをクリア
            }
        });
    </script>
</body>
</html>
