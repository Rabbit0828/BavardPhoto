<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>結果</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>結果</h1>
    <p><?php echo htmlspecialchars($_GET['message']); ?></p>
    <a href="index.php" class="action-button">戻る</a>
</body>
</html>
