<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require '../HeaderFile/header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>画像の下にポップアップ</title>
<style>
/* ポップアップ用のスタイル */
.popup {
  display: block;
  background-color: white;
  padding: 20px;
  border: 2px solid black;
  width: 800px; /* 固定幅を設定 */
  max-width: 100%; /* 画像がポップアップより大きい場合、ポップアップの幅に収まるようにする */
  margin: 20px auto;
  position: relative;
}


.popup-content {
  display: flex;
  flex-direction: row;
  gap: 20px;
}

.popup img {
  width: 50%;
  height: auto;
  aspect-ratio: 1 / 1;
  object-fit: cover;
}

.popup .text-content {
  display: flex;
  flex-direction: column;
  width: 50%;
  justify-content: space-between;
}

.popup .user-info {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 10px;
}

.popup .user-info img {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  object-fit: cover;
}

.popup .description {
  margin-bottom: 20px;
}

.popup .comments {
  margin-top: 20px;
}

.comment-popup {
  display: none; /* 初期状態では非表示 */
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border: 2px solid black;
  z-index: 1000;
}

.comment-popup form {
  display: flex;
  flex-direction: column;
}

.comment-popup form input, .comment-popup form textarea {
  margin-bottom: 10px;
  padding: 8px;
  width: 100%;
  box-sizing: border-box;
}

.comment-popup form button {
  padding: 8px;
  background-color: #007BFF;
  color: white;
  border: none;
  cursor: pointer;
}
.button-group {
  display: flex;
  flex-direction: row; /* ボタンを横に並べる */
  gap: 20px; /* ボタン間の間隔 */
  margin-top: 20px;
  align-items: center; /* 垂直方向に中央揃え */
}

.button-group button {
  padding: 10px;
  border: 2px solid #DC34E0; /* 枠線の色を設定 */
  cursor: pointer;
  color: white; /* マークの色を設定 */
  display: flex;
  align-items: center;
  gap: 5px;
  width: 60px; /* ボタンの幅を狭く設定 */
  justify-content: center; /* テキストを中央に揃える */
  background-color: black; /* 背景色を黒に設定 */
}

.like-button {
  background-color: black;
}

.bookmark-button {
  background-color: black;
}

.comment-button {
  background-color: black;
}

.like-button::before, .bookmark-button::before, .comment-button::before {
  color: white; /* マークの色を白に設定 */
}

.like-button::before {
  content: '❤️';
}

.bookmark-button::before {
  content: '⭐';
}

.comment-button::before {
  content: '💬';
}

/* $like_count と $comment_count のスタイル */
.count {
  font-size: 16px;
  color: #333;
}


.comments {
  max-height: 200px; /* 最大高さを設定 */
  overflow-y: auto; /* 縦方向にスクロールを追加 */
  border: 1px solid #ccc; /* ボーダーを追加して視覚的に区切る */
  padding: 10px; /* 内側のパディングを追加 */
}

.comments ul {
  list-style-type: none; /* リストマーカーを削除 */
  padding: 0; /* リストのパディングを削除 */
}

.comments li {
  margin-bottom: 10px; /* 各コメントの間にスペースを追加 */
}

/* 追加 */
.slide-container {
  position: relative;
  overflow: hidden;
}

.slide-container img {
  width: 100%;
  height: auto;
  display: block;
  transition: transform 0.5s ease;
}

.slide-container .prev,
.slide-container .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  padding: 10px;
  z-index: 1;
}

.slide-container .prev {
  left: 0;
}

.slide-container .next {
  right: 0;
}

</style>
</head>
<body>

<?php
try {
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);        
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQLクエリの作成
    $sql = "SELECT * FROM Post WHERE image_id = :image_id";
    
    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);
    
    // パラメータのバインド
    $image_id = 2; // 取得したいレコードのimage_idに置き換えてください
    $stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
    
    // クエリの実行
    $stmt->execute();
    
    // データのフェッチ
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // 変数に代入
    if ($result) {
        $image_id = $result['image_id'];
        $user_id = $result['user_id'];
        $image_name = $result['image_name'];
        $image_name2 = $result['image_name2'];
        $image_name3 = $result['image_name3'];
        $image_name4 = $result['image_name4'];
        $time = $result['time'];
        $comment = $result['comment'];
        
        $user_sql = "SELECT user_name, icon FROM UserTable WHERE user_id = :user_id";
        $user_stmt = $pdo->prepare($user_sql);
        $user_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $user_stmt->execute();
        
        $user_result = $user_stmt->fetch(PDO::FETCH_ASSOC);
        if ($user_result) {
            $user_name = $user_result['user_name'];
            $user_icon = $user_result['icon'];
        } else {
            $user_name = 'Unknown User';
        }
        
        $comment_sql = "SELECT Comment.comment, UserTable.user_name, UserTable.icon
                        FROM Comment
                        JOIN UserTable ON Comment.user_id = UserTable.user_id
                        WHERE Comment.image_id = :image_id";
        $comment_stmt = $pdo->prepare($comment_sql);
        $comment_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $comment_stmt->execute();
        $comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

        // Niceテーブルからいいねの数を取得
        $like_sql = "SELECT COUNT(*) AS like_count FROM Nice WHERE image_id = :image_id";
        $like_stmt = $pdo->prepare($like_sql);
        $like_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $like_stmt->execute();
        $like_count = $like_stmt->fetch(PDO::FETCH_ASSOC)['like_count'];

        // Commentテーブルからコメントの数を取得
        $comment_count_sql = "SELECT COUNT(*) AS comment_count FROM Comment WHERE image_id = :image_id";
        $comment_count_stmt = $pdo->prepare($comment_count_sql);
        $comment_count_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $comment_count_stmt->execute();
        $comment_count = $comment_count_stmt->fetch(PDO::FETCH_ASSOC)['comment_count'];

    } else {
        echo "No data found.";
    }
    
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>
<div class="popup" id="Post">
  <div class="popup-content">
    <!-- PHPで取得した画像のパスを表示 -->
    <div class="slide-container">

    <?php echo '<img src="../images/'. htmlspecialchars($image_name) . '" alt="ピカチュウ">';?>
    <?php echo '<img src="../images/'. htmlspecialchars($image_name2) . '" alt="ピカチュウ">';?>
    <?php echo '<img src="../images/'. htmlspecialchars($image_name3) . '" alt="ピカチュウ">';?>
    <?php echo '<img src="../images/'. htmlspecialchars($image_name4) . '" alt="ピカチュウ">';?>
   
      <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
      <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <div class="text-content">
      <div>
        <div class="user-info">
        <?php
        echo '<img src="../images/' . htmlspecialchars($user_icon) . '" alt="ユーザーアイコン" class="user-icon">';?>
        <a href="../G4-1/profile.php?id=<?php echo $user_id; ?>" id="username"><?php echo $user_name; ?></a>
        </div>
        <div class="description">
          <!-- PHPで取得したコメントを表示 -->
          <p id="description"><?php echo htmlspecialchars($comment); ?></p>
        </div>
        <div class="comments">
          <strong>コメント:</strong>
          <ul id="commentList">
            <?php foreach ($comments as $comment) : ?>
              <li>
                <div class="comment-item">
                 <?php echo '<img src="../images/' . htmlspecialchars($comment['icon']).'" alt="ユーザーアイコン" style="width: 40px;">';?>
                  <strong><?php echo htmlspecialchars($comment['user_name']); ?>:</strong>
                  <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="button-group">
        <button class="like-button" onclick="like()"></button>
        <span class="count"><?php echo $like_count; ?></span>
        <button class="bookmark-button" onclick="bookmark()"></button>
        <button class="comment-button" onclick="openCommentPopup()"></button>
        <span class="count"><?php echo $comment_count; ?></span>
      </div>
    </div>
  </div>
</div>

<!-- コメント用ポップアップウィンドウ -->
<div class="comment-popup" id="commentPopup">
    <form>
        <label for="comment">コメント:</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>
        <button type="button" onclick="submitComment()">送信</button>
    </form>
</div>

<script>
  let slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    let i;
    const slides = document.querySelectorAll('.slide-container img');
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
  }

  function like() {
    const imageId = <?php echo json_encode($image_id); ?>;
    
    fetch('like.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ image_id: imageId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // 成功した場合、いいねの数を更新する
            document.querySelector('.count').textContent = data.like_count;
        } else {
            console.error('いいねの処理に失敗しました:', data.error);
        }
    })
    .catch(error => console.error('Error:', error));
  }

  function bookmark() {
    // ブックマークボタンの処理をここに追加
  }

  function openCommentPopup() {
    document.getElementById('commentPopup').style.display = 'block';
  }
  
  function submitComment() {
    const comment = document.getElementById('comment').value;
    const imageId = <?php echo json_encode($image_id); ?>;
    
    fetch('submit_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ comment: comment, image_id: imageId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('コメントが送信されました');
            // 新しいコメントをコメントリストに追加
            const commentList = document.getElementById('commentList');
            const newComment = document.createElement('li');
            newComment.innerHTML = `
                <div class="comment-item">
                  <img src="${data.user_icon}" alt="ユーザーアイコン" style="width: 40px;">
                  <strong>${data.user_name}:</strong>
                  <p>${data.comment}</p>
                </div>
            `;
            commentList.appendChild(newComment);
            // コメントポップアップを閉じる
            document.getElementById('commentPopup').style.display = 'none';
        } else {
            console.error('コメントの送信に失敗しました:', data.error);
        }
    })
    .catch(error => console.error('Error:', error));
  }
</script>
</body>
</html>