<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
    
    // 画像のアップロード処理
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $upload_dir = 'uploads/';
        $upload_file = $upload_dir . basename($_FILES['photo']['name']);
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $upload_file)) {
            $photo_path = $upload_file;
        } else {
            $photo_path = 'アップロードに失敗しました。';
        }
    } else {
        $photo_path = '写真がアップロードされていません。';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>投稿結果</title>
    <link rel="stylesheet" href="G5-1.css">
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="history.back();">←</button>
        <h1>投稿結果</h1>
        <div class="result">
            <p><strong>コメント:</strong> <?php echo nl2br($comment); ?></p>
            <p><strong>写真:</strong> <img src="<?php echo $photo_path; ?>" alt="投稿写真"></p>
        </div>
    </div>
</body>
</html>
