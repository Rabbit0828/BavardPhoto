<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>CSS入門-ヘッダーとフッターの固定表示</title>
<link rel="stylesheet" href="styles.css">
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
  }
  .icon-container, .icon-back {
    display: flex;
    gap: 10px;
  }
  .icon img, .icon-back img {
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
    position: absolute;
    top: 10px;
    right: 20px;
  }
  .menu-toggle-button {
    display: flex;
    flex-direction: column;
    gap: 5px;
  }
  .menu-toggle-button span {
    display: block;
    width: 25px;
    height: 3px;
    background-color: #DC34E0; /* 三本線の色を指定 */
  }
  .menu {
    display: none;
  }
  #menu-toggle-checkbox:checked + .menu-toggle-button + .menu {
    display: block;
  }
  .icon-container {
    position: relative;
    left: -100px; /* 左に100px移動 */
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
      <a href="login.php" target="_self">
        <img src="../images/normal_icon.png" alt="ログイン" style="height: 70px; width:75px;" border="0">
      </a>
    </div>

    <!-- 位置情報に枠線を追加 -->
    <div class="icon icon2">
      <a href="favorite.php" target="_self">
        <img src="../images/gps.png" alt="お気に入り" style="height: 70px;width:75px;" border="0">
      </a>
    </div>

    <!-- アップロードを追加 -->
    <div class="icon icon3">
      <a href="photo_upp_button.php" target="_self">
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
      <li><a href="#">Home</a></li>
      <li><a href="#">Post</a></li>
      <li><a href="#">Toukou</a></li>
      <li><a href="#">My Page</a></li>
      <li><a href="#">Option</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>
</div>
</body>
</html>