<?php
// セッションが既に開始されている場合のチェック
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 定数の定義（未定義の場合のみ）
if (!defined('SERVER')) define('SERVER', 'mysql304.phy.lolipop.lan');
if (!defined('DBNAME')) define('DBNAME', 'LAA1517469-photos');
if (!defined('USER')) define('USER', 'LAA1517469');
if (!defined('PASS')) define('PASS', 'Pass1234');

// データベース接続
try {
    $pdo = new PDO("mysql:host=" . SERVER . ";dbname=" . DBNAME, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続エラー: ' . htmlspecialchars($e->getMessage());
    exit;
}

// 現在のユーザーIDをセッションから取得
$current_user_id = isset($_SESSION['UserTable']['id']) ? intval($_SESSION['UserTable']['id']) : 0;

// 受信者IDの取得と検証
$recipient_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($recipient_id <= 0) {
    echo '無効な受信者IDです。';
    exit;
}

// 現在のユーザーと受信者IDの検証
if ($current_user_id <= 0) {
    echo 'ログインユーザーが無効です。';
    exit;
}

// チャットメッセージを取得
try {
    $sql = "SELECT um.user_name, um.icon, cm.message, cm.sent_at 
            FROM ChatMessage cm 
            JOIN UserTable um ON um.user_id = cm.sender_id 
            WHERE ((cm.sender_id = :current_user_id AND cm.recipient_id = :recipient_id) 
                OR (cm.sender_id = :recipient_id AND cm.recipient_id = :current_user_id)) 
            ORDER BY cm.sent_at";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':current_user_id' => $current_user_id,
        ':recipient_id' => $recipient_id
    ]);
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>チャットメッセージ</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="chat-container">
        <?php if ($messages): ?>
            <?php foreach ($messages as $message): ?>
                <div class="message">
                    <div class="message-icon">
                        <img src="../images/<?php echo htmlspecialchars($message['icon'], ENT_QUOTES, 'UTF-8'); ?>" alt="アイコン">
                    </div>
                    <div class="message-content">
                        <strong><?php echo htmlspecialchars($message['user_name'], ENT_QUOTES, 'UTF-8'); ?></strong>
                        <p><?php echo htmlspecialchars($message['message'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <span class="timestamp"><?php echo htmlspecialchars($message['sent_at'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>メッセージはありません。</p>
        <?php endif; ?>
    </div>
</body>
</html>
