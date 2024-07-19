<?php
if (!isset($_SESSION['UserTable']['id'])) {
    // Handle the case where the user is not logged in
    header('Location: ../G1-1/G1-1-input.php');
    exit;
}
$user_id = $_SESSION['UserTable']['id'];
$icon_path = '../images/' . $_SESSION['UserTable']['icon'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>BavardPhotos</title>
<link rel="icon" href="../images/BPfavicon2.ico" type="image/x-icon">
<link rel="stylesheet" href="background/style.css">
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

  .logo img {
    height: 70px;
    width: 200px;
  }

  .icon-container{
    display: flex;
    gap: 10px;
    margin-right:10px;
  }

  .icon img {
    height: 70px;
    width: 75px;
    border-radius: 50%; /* This line makes the image circular */
    object-fit: cover; /* This ensures the image covers the entire circle */
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
    margin-right:50px;
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

  #menu-toggle-checkbox:checked + .menu-toggle-button + .menu {
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

    .logo {
      order: 1;
      width: 100%;
      margin-bottom: 10px;
      position: static;
      margin: 0 auto;
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
      margin-left: 900px;
      display: block;
    }
  }
</style>
</head>
<body>
<div id="background"></div>
<script src="background/script.js"></script>
<div class="Header">
  <div class="logo">
    <a href="../G2-1/G2-1.php" target="_self">
      <img src="../images/logo.png" alt="ホーム">
    </a>
  </div>

  <div class="search-container">

  </div>

  <div class="icon-container">
    <div class="icon icon1">
      <a href="../G4-2/myprofile.php?id=<?php echo $user_id; ?>" id="username" target="_self">
        <img src="<?php echo $icon_path; ?>" alt="ログイン">
      </a>
    </div>
    <div class="icon icon1">
      <a href="../G2-1/G2-1-Nice.php?id=<?php echo $user_id; ?>" id="username" target="_self">
        <img src="../images/love.png" alt="love">
      </a>
    </div>
    <div class="icon icon3">
      <a href="../G5-1/input.php" target="_self">
        <img src="../images/photo_upp_button.png" alt="カート">
      </a>
    </div>
    <div class="icon icon3">           
      <a href="../chat/chat_list.php" target="_self">
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
      <li><a href="../G6-2/input.php">利用規約</a></li>
    </ul>
  </div>
</div>
<script>
// ウィンドウのリサイズイベントを監視して、条件に応じてbody要素にクラスを追加・削除する
window.addEventListener('resize', function() {
    const body = document.querySelector('body');
    if (window.innerWidth <= 768) {
        body.classList.add('tab-shrink');
    } else {
        body.classList.remove('tab-shrink');
    }
});
</script>
</body>
</html>
