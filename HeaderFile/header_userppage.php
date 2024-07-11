<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>BavardPhoto</title>
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
    background-color: #333;
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
</style>
</head>
<body>
<div class="Header">
  <!-- 戻るボタン-->
  <div class="icon-back">
    <a href="javascript:history.back()" target="_self">
      <img src="../images/left_button.png" alt="戻る" border="0">
    </a>
  </div>

  <!-- ユーザー名表示-->
  <div class="user-name-container">
    <p class="user-name">user_name</p>
  </div>
    
</div>
</body>
</html>
