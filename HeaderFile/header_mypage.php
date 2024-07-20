<?php
session_start();
require '../G4-2/dbconnect.php'; // データベース接続ファイル

// 現在のユーザーIDを取得
$user_id = $_SESSION['UserTable']['id'];

// 未読の通知カウントを取得
$stmt = $pdo->prepare('SELECT COUNT(*) AS count FROM Notifications WHERE user_id = ? AND seen = 0');
$stmt->execute([$user_id]);
$notification_count = $stmt->fetchColumn();

// 通知がある場合のクラスを設定
$notification_class = $notification_count > 0 ? 'notification-dot' : '';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>BavardPhoto</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Header style */
        .Header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            height: 100px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 0px; /* 左に余白を追加 */
        }
        .icon-container {
            display: flex;
            gap: 10px;
            margin-right: 10px; /* 左に20px移動 */
            position: relative; /* 相対位置に設定 */
        }
        .icon img {
            height: 70px;
            width: 75px;
            border-radius: 50%; /* この行で画像を円形にする */
            object-fit: cover; /* 画像が円形をカバーするようにする */
        }
        .notification-dot {
            position: absolute;
            top: 0;
            right: 0;
            width: 10px;
            height: 10px;
            background-color: red;
            border-radius: 50%;
        }
        .menu-toggle {
            display: flex;
            align-items: center;
            margin-right: 50px; /* 左に20px移動 */
        }
        .menu-toggle-button {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 24px;
            cursor: pointer;
            z-index: 1001; /* メニューアイコンを前面に表示 */
        }
        .menu-toggle-button span {
            display: block;
            width: 100%;
            height: 4px;
            background-color: #DC34E0; /* 三本線の色を指定 */
            transition: transform 0.3s, opacity 0.3s;
        }
        #menu-toggle-checkbox {
            display: none; /* チェックボックスを非表示にする */
        }
        #menu-toggle-checkbox:checked + .menu-toggle-button span:nth-child(1) {
            transform: rotate(45deg) translateY(10px);
        }
        #menu-toggle-checkbox:checked + .menu-toggle-button span:nth-child(2) {
            opacity: 0;
        }
        #menu-toggle-checkbox:checked + .menu-toggle-button span:nth-child(3) {
            transform: rotate(-45deg) translateY(-10px);
        }
        .menu {
            display: none;
            position: absolute;
            top: 100%; /* ヘッダーの下に表示 */
            right: 0;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 999; /* メニューを前面に表示 */
            width: 200px; /* メニューの幅を指定 */
        }
        .menu li {
            list-style: none;
        }
        .menu li a {
            display: block;
            padding: 10px 20px;
            color: black;
            text-decoration: none;
        }
        .menu li a:hover {
            background-color: #f0f0f0;
        }
        @media screen and (max-width: 768px) {
            .Header {
                flex-wrap: wrap;
                justify-content: center;
                height: auto;
            }
            .logo {
                order: 1;
                width: 100%;
                text-align: center;
                margin-bottom: 10px;
            }
            .icon-container {
                order: 2;
                justify-content: center;
                width: 100%;
                margin-bottom: 10px;
            }
            .menu-toggle {
                order: 3;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="Header">
    <div class="logo">
        <a href="../G2-1/G2-1.php" target="_self">
            <img src="../images/logo.png" alt="ホーム" style="height: 70px;width:200px;" border="0">
        </a>
    </div>

    <?php
    if (isset($_SESSION['UserTable']['name'])){
        echo '<div class="user-container">';
        echo '<p>',$_SESSION['UserTable']['name'],'</p>';
        echo '</div>';
    } else {
        echo "<p>存在しません。</p>";
    }
    ?>

    <div class="icon-container">
        <!-- 他のアイコン -->

        <!-- チャットアイコンと通知表示 -->
        <div class="icon icon3">
            <a href="../chat/chat_list.php" target="_self">
                <img src="../images/chat.png" alt="チャット" style="height: 70px;width:75px;" border="0">
                <?php if ($notification_count > 0): ?>
                    <div class="<?php echo $notification_class; ?>"></div>
                <?php endif; ?>
            </a>
        </div>
        
        <!-- 他のアイコン -->
    </div>

    <div class="menu-toggle">
        <input type="checkbox" id="menu-toggle-checkbox" />
        <label for="menu-toggle-checkbox" class="menu-toggle-button">
            <span></span>
            <span></span>
            <span></span>
        </label>
        <ul class="menu">
            <li><a href="../G2-1/G2-1.php">Home</a></li>
            <li><a href="../G5-1/input.php">Post</a></li>
            <li><a href="../G4-2/myprofile.php?id=<?php echo $user_id; ?>">My Page</a></li>
            <li><a href="../G1-4-1/G1-4-1-input.php">Logout</a></li>
            <li><a href="../G6-2/input.php">利用規約</a></li>
        </ul>
    </div>
</div>
</body>
</html>

