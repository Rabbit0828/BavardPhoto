<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
// 最初のセッション開始時に last_activity を設定
  if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
    //header_mypageで使うため宣言
    $_SESSION['UserTable']['name'] ;
  }

  // 最後の活動から30分以上経過している場合、セッションを破棄
  if (time() - $_SESSION['last_activity'] > 60) { // 1800秒 = 30分
      session_unset(); // セッション変数をクリア
      session_destroy(); // セッションを破棄
      header("Location:../G1-1/G1-1-input.php");
      exit(); // スクリプトの実行を終了
  }

  // ユーザーがアクティブな場合、last_activity を更新
  $_SESSION['last_activity'] = time();
  ?>