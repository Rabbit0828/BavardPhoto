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
  z-index: 1000;
}

.icon-container {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-right: auto; /* 左端に配置 */
}

.icon-container img{
  height: 75px;
  width: 125px;
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

.icon-container {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: auto; /* 右端に配置 */
}

.icon img {
  height: 70px;
  width: 70px;
}

.menu-toggle {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: 20px; /* icon-containerの右に配置 */
}

.menu-toggle-button {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 30px;
  height: 24px;
  cursor: pointer;
  z-index: 1001;
}

.menu-toggle-button span {
  display: block;
  width: 100%;
  height: 4px;
  background-color: #DC34E0;
  transition: transform 0.3s, opacity 0.3s;
}

#menu-toggle-checkbox {
  display: none;
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
  top: 100%;
  right: 0;
  background-color: white;
  border: 1px solid #ddd;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  z-index: 999;
  width: 200px;
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

#menu-toggle-checkbox:checked ~ .menu {
  display: block;
}

.search-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-grow: 1;
}

.search-container input[type="text"] {
  height: 40px;
  width: 300px;
  padding: 5px 10px;
  font-size: 16px;
  border: 2px solid #DC34E0;
  color: #DC34E0;
}

@media screen and (max-width: 768px) {
  .Header {
    flex-wrap: wrap;
    justify-content: center;
    height: auto;
  }
  .user-name-container {
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
  <!-- 戻るボタン-->
  <div class="icon-container">
    <a href="javascript:history.back()" target="_self">
      <img src="../images/logo.png" alt="戻る" border="0">
    </a>
  </div>

  <!-- ユーザー名表示-->
  <div class="user-name-container">
    <p class="user-name">my_page</p>
  </div>

  <!-- アイコンコンテナ -->
  <div class="icon-container">
    <!-- 位置情報に枠線を追加 -->
    <div class="icon">
      <a href="favorite.php" target="_self">
        <img src="../images/location_information.png" alt="お気に入り" border="0">
      </a>
    </div>

    <!-- アップロードを追加 -->
    <div class="icon">
      <a href="../G5-1/input.php" target="_self">
        <img src="../images/photo_upp_button.png" alt="カート" border="0">
      </a>
    </div>
  </div>

  <!-- メニュートグル -->
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
      <li><a href="#">Option</a></li>
      <li><a href="../G1-4-1/G1-4-1-input.php">Logout</a></li>
    </ul>
  </div>
</div>
</body>
</html>
