<?php
if (!isset($_SESSION['UserTable']['id'])) {
    // Handle the case where the user is not logged in
    echo "User not logged in!";
    exit;
}
$user_id = $_SESSION['UserTable']['id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>BavardPhotos</title>
<link rel="icon" href="../images/BPfavicon.ico" type="image/x-icon">
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
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px 20px; /* Adjust as needed */
  }

  .logo img {
    height: 70px;
    width: 200px;
  }

  .icon-container, .menu-toggle {
    display: flex;
    gap: 10px;
    margin-right: 40px;
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
    margin-left: -20px;
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
      text-align: center;
      margin-bottom: 10px;
      position: static;
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
      <img src="../images/logo.png" alt="ホーム">
    </a>
  </div>

  <div class="search-container">

  </div>

  <div class="icon-container">
    <div class="icon icon1">
      <a href="../G4-2/myprofile.php?id=<?php echo $user_id; ?>" id="username" target="_self">
        <img src="../images/normal_icon.png" alt="ログイン">
      </a>
    </div>
    <div class="icon icon3">
      <a href="../G5-1/input.php" target="_self">
        <img src="../images/photo_upp_button.png" alt="カート">
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
      <li><a href="../G5-1/input.php">Post</a></li>
      <li><a href="../G4-2/myprofile.php?id=<?php echo $user_id; ?>">My Page</a></li>
      <li><a href="../G1-4-1/G1-4-1-input.php">Logout</a></li>
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
