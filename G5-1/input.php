<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>写真とテキストのアップロード</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">ファイルを選択:</label>
        <input type="file" name="file" id="file" required><br>
        <label for="description">説明文:</label>
        <input type="text" name="description" id="description" required><br>
        <input type="submit" value="アップロード">
    </form>
</body>
</html>