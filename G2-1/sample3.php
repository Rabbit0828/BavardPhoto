<?php require 'db-connect.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>画像の下にポップアップ</title>
<style>
/* ポップアップ用のスタイル */
.popup {
  display: block; /* 最初から表示 */
  background-color: white;
  padding: 20px;
  border: 2px solid black;
  width: 80%;
  max-width: 800px;
  margin: 20px auto;
}

.popup-content {
  display: flex;
  flex-direction: row;
  gap: 20px;
}

.popup img {
  width: 50%;
  height: auto;
  aspect-ratio: 1/1;
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
  gap: 10px;
  margin-top: 20px;
  justify-content: center;
}

.button-group button {
  padding: 10px;
  border: none;
  cursor: pointer;
  color: white;
  display: flex;
  align-items: center;
  gap: 5px;
}

.like-button {
  background-color: #e74c3c;
}

.bookmark-button {
  background-color: #f39c12;
}

.comment-button {
  background-color: #007BFF;
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
            
            $user_sql = "SELECT user_name,icon FROM UserTable WHERE user_id = :user_id";
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

            // データの確認（必要に応じて）
            echo "Image ID: $image_id\n";
            echo "User ID: $user_id\n";
            echo "Image Name: $image_name\n";
            echo "Image Name2: $image_name2\n";
            echo "Image Name3: $image_name3\n";
            echo "Image Name4: $image_name4\n";
            echo "Time: $time\n";
            echo "Comment: $comment\n";
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
    <img src="<?php echo htmlspecialchars($image_name); ?>" alt="ピカチュウ">
    <div class="text-content">
      <div>
        <div class="user-info">
        <img src="<?php echo htmlspecialchars($user_icon); ?>" alt="ユーザーアイコン" class="user-icon">
          <a href="#" id="username"><?php echo htmlspecialchars($user_name); ?></a>
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
                <img src="<?php echo htmlspecialchars($comment['icon']); ?>" alt="ユーザーアイコン" style="width: 40px;">
                  <strong><?php echo htmlspecialchars($comment['user_name']); ?>:</strong>
                  <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="button-group">
        <button class="like-button" onclick="like()">いいね</button>
        <button class="bookmark-button" onclick="bookmark()">ブックマーク</button>
        <button class="comment-button" onclick="openCommentPopup()">コメントを書く</button>
      </div>
    </div>
  </div>
</div>

<!-- コメント用ポップアップウィンドウ -->
<div class="comment-popup" id="commentPopup" style="display: none;">
  <form id="commentForm">
    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required>
    <label for="comment">コメント:</label>
    <textarea id="comment" name="comment" rows="4" required></textarea>
    <button type="submit">送信</button>
  </form>
</div>

<script>
function openCommentPopup() {
  document.getElementById("commentPopup").style.display = "block";
}

document.getElementById("commentForm").addEventListener("submit", function(event) {
  event.preventDefault();
  // ここにコメントを送信するためのロジックを追加できます
  const commentList = document.getElementById("commentList");
  const name = document.getElementById("name").value;
  const comment = document.getElementById("comment").value;
  const newComment = document.createElement("li");
  newComment.textContent = `${name}: ${comment}`;
  commentList.appendChild(newComment);
  alert("コメントが送信されました！");
  document.getElementById("commentPopup").style.display = "none";
});

function like() {
  // ここに「いいね」ボタンがクリックされたときのロジックを追加します
  alert("いいねしました！");
}

function bookmark() {
  // ここに「ブックマーク」ボタンがクリックされたときのロジックを追加します
  alert("ブックマークしました！");
}
</script>
</body>
</html>