<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhotos</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
    margin: 0;  /* 余白をなくす */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;  /* 画面全体の高さに合わせる */
}

.upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.upload-area {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
    text-align: center;
}

.upload-label {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 200px;
    height: 200px;
    border: 2px dashed #ccc;
    border-radius: 10px;
    cursor: pointer;
    position: relative;
    background-color: #fafafa;
}

.upload-label::before {
    content: "+";
    font-size: 50px;
    color: #ccc;
    position: absolute;
}

.upload-instructions {
    margin-top: 10px;
}

.upload-instructions p {
    margin: 5px 0;
    color: #666;
    font-size: 14px;
}

#file {
    display: none;
}

.preview-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin-bottom: 20px;
}

.preview-container img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

.comment-box {
    display: block;
    width: 100%;
    max-width: 400px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 14px;
    margin: 0 auto;
}

.submit-button {
    padding: 10px 20px;
    background-color: #DC34E0;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
    display: block;
    margin: 20px auto 0 auto;
}

.submit-button:hover {
    background-color: #c12ec7;
}

    </style>
</head>
<body>
    <div class="upload-container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
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
            <input type="submit" value="アップロード" class="submit-button">
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
    </script>
</body>
</html>
