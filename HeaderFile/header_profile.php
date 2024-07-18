<?php
if (!isset($_SESSION['UserTable']['id'])) {
    // Handle the case where the user is not logged in
    header('Location: ../G1-1/G1-1-input.php');
    exit;
}
$user_id = $_SESSION['UserTable']['id'];
$icon_path = '../images/' . $_SESSION['UserTable']['icon'];
?>
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
  .icon-container, .menu-toggle {
    display: flex;
    gap: 10px;
    margin-right: 40px; /* 左に20px移動 */
  }
  .icon img {
    height: 70px;
    width: 75px;
  }
  .menu-toggle {
    display: flex;
    align-items: center;
    margin-left: -20px; /* 左に20px移動 */
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
  #menu-toggle-checkbox:checked + .menu-toggle-button + .menu {
    display: block;
  }
  .user-container {
    display: flex;
    justify-content: center; /* 中央揃え */
    align-items: center; /* 縦方向の中央揃え */
    flex-grow: 1; /* 余白を全て埋める */
  }
  .user-container p {
    font-size: 36px;
    font-weight: bold;
    margin: 0;
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
    .user-container {
      order: 2;
      width: 100%;
      margin-bottom: 10px;
    }
    .icon-container {
      order: 3;
      justify-content: center;
      width: 100%;
      margin-bottom: 10px;
    }
    .menu-toggle {
      order: 4;
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

 
  <?php require '../G5-1/db-connect.php'; ?>
  <?php
    $user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    $user_sql = 'SELECT * FROM UserTable WHERE user_id = :user_id';
    $user_stmt = $pdo->prepare($user_sql);
    $user_stmt->execute([':user_id' => $user_id]);
    $user = $user_stmt->fetch();

    if ($user){
      echo '<div class="user-container">';
      echo '<p>';
      echo htmlspecialchars($user['user_name'] ?? '', ENT_QUOTES, 'UTF-8');
      echo '</p>';
      echo '</div>';
    }else{
    echo "<p>存在しません。</p>";
  }
  ?>
  

  <!-- アイコンに枠線を追加 -->
  <div class="icon-container">
  <div class="icon icon1">
      <a href="../G4-2/myprofile.php?id=<?php echo $user_id; ?>" id="username" target="_self">
        <img src="<?php echo $icon_path; ?>" alt="ログイン">
      </a>
    </div>
    <!-- アップロードを追加 -->
    <div class="icon icon2">
      <a href="../G5-1/input.php" target="_self">
        <img src="../images/photo_upp_button.png" alt="アップ" style="height: 70px;width:75px;" border="0">
      </a>
    </div>

    <div class="icon icon3">            <!--修正作業よろしく-->
      <a href="../chat/chat.php?user_id=<?php echo $user_id;?>" target="_self">
        <img src="../images/chat.png" alt="チャット" style="height: 70px;width:75px;" border="0">
      </a>
    </div>
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
    </ul>
  </div>
</div>
