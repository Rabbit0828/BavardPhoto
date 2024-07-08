<?php
session_start();
require '../G4-1/dbconnect.php'; // Adjust the path as needed

$current_user_id = $_SESSION['id'];
$chat_user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($chat_user_id == 0) {
    echo '無効なユーザーIDです。';
    exit;
}

// チャット相手のユーザー情報を取得
$user_sql = 'SELECT user_name FROM UserTable WHERE user_id = :user_id';
$user_stmt = $pdo->prepare($user_sql);
$user_stmt->execute([':user_id' => $chat_user_id]);
$chat_user = $user_stmt->fetch();

if (!$chat_user) {
    echo 'ユーザーが見つかりません。';
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>チャット - <?php echo htmlspecialchars($chat_user['user_name']); ?></title>
    <link rel="stylesheet" href="css/chat.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/chat.js"></script>
</head>
<body>
    <h1><?php echo htmlspecialchars($chat_user['user_name']); ?> さんとのチャット</h1>
    <div id="chat-box"></div>
    <form id="chat-form">
        <input type="hidden" name="current_user_id" value="<?php echo $current_user_id; ?>">
        <input type="hidden" name="chat_user_id" value="<?php echo $chat_user_id; ?>">
        <textarea name="message" rows="3" cols="50" required></textarea>
        <button type="submit">送信</button>
    </form>
</body>
</html>


