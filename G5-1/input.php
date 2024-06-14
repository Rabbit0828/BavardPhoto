<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>画像アップロード</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">画像を選択してください（最大4枚）:</label>
        <input type="file" name="files[]" id="file" multiple>
        <input type="text" name="comment" placeholder="コメントを入力してください">
        <input type="submit" value="アップロード">
    </form>
</body>
</html>


