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
        // すべてのユーザーを取得
        $sql = 'SELECT * FROM UserTable';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();

        // タブメニューの表示
        echo '<div class="tab">';
        echo '<button class="tablinks" data-tab="userList">ユーザー一覧</button>';
        echo '<button class="tablinks" data-tab="anotherTab">他のタブ</button>';
        echo '</div>';

        // ユーザー一覧タブのコンテンツ
        echo '<div id="userList" class="tabcontent">';
 
        echo '<input type="text" id="searchUser" placeholder="ユーザー検索">';

        if ($users) {
            echo '<ul class="user-list">';
            foreach ($users as $user) {
                echo '<li>';
                echo '<a href="../G4-1/profile.php?id=', $user['user_id'], '"><img src="../images/', htmlspecialchars($user['icon'] ?? 'default-icon.png'), '" alt="プロフィール写真">', htmlspecialchars($user['user_name'] ?? ''), '</a>';
                
                // チャットリンクを追加
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

        // 他のタブのコンテンツ（サンプル）
        echo '<div id="anotherTab" class="tabcontent">';
        echo '<h2>他のタブの内容</h2>';
        echo '<p>ここに他のタブの内容を追加します。</p>';
        echo '</div>';
    } catch (PDOException $e) {
        echo 'データベースエラー: ' . htmlspecialchars($e->getMessage());
    }
    ?>
</body>
</html>

