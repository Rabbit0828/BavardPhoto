<?php
// データベース接続ファイルを読み込む
require './dbconnect.php';

// データベースからユーザー一覧を取得
$stmt = $pdo->query('SELECT user_id, user_name FROM UserTable');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 固定の相手を指定
$partner_user_id = 1; // 例として1を指定

// 相手のユーザー名を取得
$stmt = $pdo->prepare('SELECT user_name FROM UserTable WHERE user_id = ?');
$stmt->execute([$partner_user_id]);
$partner_user = $stmt->fetch(PDO::FETCH_ASSOC);
$partner_user_name = $partner_user['user_name'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>チャットサンプル</title>
    <link type="text/css" rel="stylesheet" href="css/bmesse.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- 自分やユーザーの情報 -->
    <h3 id="me" user_id="<?php echo $user_id; ?>">あなたは<?php echo $user_name; ?>です</h3>
    <!-- 固定の相手のユーザー名を表示 -->
    <h3 id="partner" thread_id="1">相手は<?php echo $partner_user_name; ?>です</h3>
    <!-- ユーザー一覧は削除 -->
    <br>
    <!-- 以下略 -->

    <div id="your_container">
        <!-- チャットの外側部分① -->
        <div id="bms_messages_container">
            <!-- ヘッダー部分② -->
            <div id="bms_chat_header">
                <!--ステータス-->
                <div id="bms_chat_user_status">
                    <!--ステータスアイコン-->
                    <div id="bms_status_icon">●</div>
                    <!--ユーザー名-->
                    <div id="bms_chat_user_name">ユーザー</div>
                </div>
            </div>

            <!-- タイムライン部分③ -->
            <div id="bms_messages">
                <!-- メッセージがここに追加されます -->
            </div>

            <!-- テキストボックス、送信ボタン④ -->
            <div id="bms_send">
                <textarea id="bms_send_message" placeholder="メッセージを入力してください"></textarea>
                <div id="bms_send_btn">送信</div>
            </div>
        </div>
    </div>

    <script src="js/chat.js"></script>
</body>
</html>

