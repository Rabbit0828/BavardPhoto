<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>プロフィール編集</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        div {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        span {
            width: 120px;
            font-weight: bold;
            margin-bottom: 0;
            color: #777;
        }

        input[type="text"], input[type="file"] {
            flex-grow: 1;
            padding: 10px;
            border: 2px solid #DC34E0;
            border-radius: 4px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #dd4ae0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        button:hover {
            background-color: #db07e7;
        }

        #image-preview {
            width: 150px;
            height: 150px;
            border: 2px solid #ddd;
            display: none;
            margin-left: 120px; /* Align with the input fields */
            object-fit: cover;
        }
    </style>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                output.style.display = 'block';
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>
    <form action="edit-output.php" method="POST" enctype="multipart/form-data">
        <div>
            <img id="image-preview" alt="画像プレビュー">
        </div>
        <div>
            <span>プロフィール画像</span>
            <input type="file" name="profile_image" accept="image/*" onchange="previewImage(event)">
        </div>
        <div>
            <span>名前</span>
            <input type="text" name="name" placeholder="名前を変更">
        </div>
        <div>
            <span>自己紹介</span>
            <input type="text" name="syoukai" placeholder="自由に変更">
        </div>
        <button type="submit">変更</button>
    </form>
</body>
</html>