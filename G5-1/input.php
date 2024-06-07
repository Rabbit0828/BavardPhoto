<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規投稿</title>
    <link rel="stylesheet" href="G5-1.css">
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="history.back();">←</button>
        <h1>新規投稿</h1>
        <form action="output.php" method="post" enctype="multipart/form-data">
            <div class="photo-upload">
                <label for="photo">写真を追加</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="separator"></div>
            <textarea name="comment" placeholder="コメントを入力してください..."></textarea>
            <button type="submit" class="share-button">シェア</button>
        </form>
    </div>
</body>
</html>
