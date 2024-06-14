<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像アップロード</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 50px;
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
            margin-bottom: 10px;
        }

        .upload-label::before {
            content: "+";
            font-size: 50px;
            color: #ccc;
            position: absolute;
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
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .submit-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <label for="file" class="upload-label"></label>
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
