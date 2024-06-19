<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>CSS入門-ヘッダーとフッターの固定表示</title>
<style>
  .Header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    background-color: #f8f8f8;
    border-bottom: 1px solid #ddd;
    height: 100px;
    position: relative;
    z-index: 1000; /* ヘッダーを前面に表示 */
  }
  .icon-container,.menu-toggle {
    display: flex;
    gap: 10px;
    margin-right: 40px; /* 左に20px移動 */
  }
  .icon img {
    height: 70px;
    width: 75px;
  }
  .user-name-container {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
  }
  .user-name {
    font-size: 36px;
    font-weight: bold;
    margin: 0;
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
  .search-container {
    display: flex;
    justify-content: center; /* 中央揃え */
    align-items: center; /* 縦方向の中央揃え */
    flex-grow: 1; /* 余白を全て埋める */
  }
  .search-container input[type="text"] {
    height: 40px;
    width: 300px; /* 幅を指定 */
    padding: 5px 10px; /* 上下に5px、左右に10pxのパディング */
    font-size: 16px; /* フォントサイズを指定 */
    border: 2px solid #DC34E0; /* 枠線の色と太さを指定 */
    color: #DC34E0; /* 文字の色を指定 */
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
    .search-container {
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
    <a href="home.php" target="_self">
      <img src="../images/logo.png" alt="ホーム" style="height: 70px;width:200px;" border="0">
    </a>
  </div>

  <!-- 検索ボックスを追加 -->
  <div class="search-container">
    <form method="get" action="products.php">
      <input type="text" size="40" placeholder="キーワード検索"> <!-- 高さを 40px に変更 -->
    </form>
  </div>

  <!-- アイコンに枠線を追加 -->
  <div class="icon-container">
    <div class="icon icon1">
      <a href="../G4-2/myprofile.php" target="_self">
        <img src="../images/normal_icon.png" alt="ログイン" style="height: 70px; width:75px;" border="0">
      </a>
    </div>

    <!-- 位置情報に枠線を追加 -->
    <div class="icon icon2">
      <a href="https://ja.wikipedia.org/wiki/%E9%98%BF%E9%83%A8%E5%AF%9B" target="_self">
        <img src="../images/gps.png" alt="お気に入り" style="height: 70px;width:75px;" border="0">
      </a>
    </div>

    <!-- アップロードを追加 -->
    <div class="icon icon3">
      <a href="../G5-1/input.php" target="_self">
        <img src="../images/photo_upp_button.png" alt="カート" style="height: 70px;width:75px;" border="0">
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
      <li><a href="G2-1.php">Home</a></li>
      <li><a href="#">Post</a></li>
      <li><a href="../G5-1/input.php">Toukou</a></li>
      <li><a href="../G4-2/myprofile.php">My Page</a></li>
      <li><a href="#">Option</a></li>
      <li><a href="../G1-2/G1-2-1-input.php">Logout</a></li>
    </ul>
  </div>
</div>
</body>
</html>
