<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhoto</title>
    <?php require '../HeaderFile/header.php'?>
    <link rel="stylesheet" href="css/chat_list.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            // タブ切り替え機能
            $(".tablinks").on("click", function() {
                var tabId = $(this).attr("data-tab");
                $(".tabcontent").hide(); // すべてのタブコンテンツを非表示
                $("#" + tabId).show(); // クリックされたタブのコンテンツのみ表示
            });

            // ユーザー検索機能
            $("#searchUser").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".user-list li").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });

            // 初期表示: 最初のタブを表示
            $(".tablinks").first().click();
        });
    </script>
</head>
<body>
    <?php require '../G4-2/dbconnect.php'; ?>
    <?php 
    try {
        // 自分のIDを取得
        $my_id = $_SESSION['user_id']; // セッションから自分のIDを取得

        // すべてのユーザーを取得
        $sql_users = 'SELECT * FROM UserTable';
        $stmt_users = $pdo->prepare($sql_users);
        $stmt_users->execute();
        $users = $stmt_users->fetchAll();

        // 通知があるユーザーを取得
        $sql_notifications = 'SELECT DISTINCT sender_id FROM Notifications WHERE user_id = :my_id';
        $stmt_notifications = $pdo->prepare($sql_notifications);
        $stmt_notifications->execute(['my_id' => $my_id]);
        $notifications = $stmt_notifications->fetchAll(PDO::FETCH_COLUMN, 0);

        // タブメニューの表示
        echo '<div class="tab">';
        echo '<button class="tablinks" data-tab="userList">ユーザー一覧</button>';
        echo '<button class="tablinks" data-tab="notifications">通知</button>';
        echo '</div>';

        // ユーザー一覧タブのコンテンツ
        echo '<div id="userList" class="tabcontent">';
        echo '<input type="text" id="searchUser" placeholder="ユーザー検索">';
        if ($users) {
            echo '<ul class="user-list">';
            foreach ($users as $user) {
                echo '<li>';
                echo '<a href="../G4-1/profile.php?id=', $user['user_id'], '"><img src="../images/', htmlspecialchars($user['icon'] ?? 'default-icon.png'), '" alt="プロフィール写真">', htmlspecialchars($user['user_name'] ?? ''), '</a>';
                echo '<div class="chat-button">';
                echo '<a href="../chat/chat.php?user_id=', $user['user_id'], '" class="message-button">チャット</a>';
                echo '</div>';
                echo '</li>';
            }
            echo '</ul>';
        } else {
            echo 'ユーザーが見つかりません。';
        }
        echo '</div>';

        // 通知タブのコンテンツ
        echo '<div id="notifications" class="tabcontent">';
        if (!empty($notifications)) {
            echo '<ul class="user-list">';
            foreach ($notifications as $sender_id) {
                // 送信者の情報を取得
                $sql_sender = 'SELECT * FROM UserTable WHERE user_id = :sender_id';
                $stmt_sender = $pdo->prepare($sql_sender);
                $stmt_sender->execute(['sender_id' => $sender_id]);
                $sender = $stmt_sender->fetch();

                if ($sender) {
                    echo '<li>';
                    echo '<a href="../G4-1/profile.php?id=', $sender['user_id'], '"><img src="../images/', htmlspecialchars($sender['icon'] ?? 'default-icon.png'), '" alt="プロフィール写真">', htmlspecialchars($sender['user_name'] ?? ''), '</a>';
                    echo '<div class="chat-button">';
                    echo '<a href="../chat/chat.php?user_id=', $sender['user_id'], '" class="message-button">チャット</a>';
                    echo '</div>';
                    echo '</li>';
                }
            }
            echo '</ul>';
        } else {
            echo '通知はありません。';
        }
        echo '</div>';

    } catch (PDOException $e) {
        echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    }
    ?>
</body>
</html>

