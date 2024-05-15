<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>CSS入門-ヘッダーとフッターの固定表示</title>
<link rel="stylesheet" href="styles.css">
<style>
  .search-container {
    display: flex;
    justify-content: center;
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
      <input type="text" size="40" style="height: 40px;" placeholder="キーワード検索"> <!-- 高さを 40px に変更 -->
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
        <img src="../images/location_information.png" alt="お気に入り" style="height: 70px;width:75px;" border="0">
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
      <li><a href="#">Story</a></li>
      <li><a href="#">Toukou</a></li>
      <li><a href="#">My Page</a></li>
      <li><a href="#">Option</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </div>
</div>
</body>
</html>
