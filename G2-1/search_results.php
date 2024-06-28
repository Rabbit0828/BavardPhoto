<?php
session_start();
require 'db-connect.php';
require '../HeaderFile/header.php';

if (!isset($_GET['search'])) {
    echo "検索クエリが指定されていません。";
    exit;
}

$search_query = $_GET['search'];
$search_type = 'default';

// プレフィックスに基づいて検索タイプを決定
if (strpos($search_query, 'img:') === 0) {
    $search_type = 'image_id';
    $search_query = substr($search_query, 4);  // プレフィックスを削除
} elseif (strpos($search_query, 'user:') === 0) {
    $search_type = 'user_id';
    $search_query = substr($search_query, 5);  // プレフィックスを削除
} elseif (strpos($search_query, 'name:') === 0) {
    $search_type = 'user_name';
    $search_query = substr($search_query, 5);  // プレフィックスを削除
} else {
    // プレフィックスがない場合はデフォルトで画像IDを検索
    $search_type = 'image_id';
}

try {
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 検索クエリを準備
    $search_sql = "";
    switch ($search_type) {
        case 'image_id':
            $search_sql = "SELECT * FROM Post 
                           JOIN UserTable ON Post.user_id = UserTable.user_id
                           WHERE Post.image_id LIKE :search";
            break;
        case 'user_id':
            $search_sql = "SELECT * FROM Post 
                           JOIN UserTable ON Post.user_id = UserTable.user_id
                           WHERE UserTable.user_id LIKE :search";
            break;
        case 'user_name':
            $search_sql = "SELECT * FROM Post 
                           JOIN UserTable ON Post.user_id = UserTable.user_id
                           WHERE UserTable.user_name LIKE :search";
            break;
        default:
            echo "無効な検索タイプが指定されました。";
            exit;
    }

    $search_stmt = $pdo->prepare($search_sql);
    $search_param = '%' . $search_query . '%';
    $search_stmt->bindParam(':search', $search_param, PDO::PARAM_STR);
    $search_stmt->execute();
    $results = $search_stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($results) {
        echo "<h2>検索結果:</h2>";
        echo "<ul>";
        foreach ($results as $result) {
            echo '<li>';
            echo '画像ID: ' . htmlspecialchars($result['image_id']) . '<br>';
            echo 'ユーザーID: ' . htmlspecialchars($result['user_id']) . '<br>';
            echo 'ユーザー名: ' . htmlspecialchars($result['user_name']) . '<br>';
            echo '</li>';
        }
        echo "</ul>";
    } else {
        echo "<p>検索結果が見つかりませんでした。</p>";
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
