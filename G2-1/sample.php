<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>画像をクリックしてポップアップ</title>
<style>
/* ポップアップ用のスタイル */
.popup, .comment-popup {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  border: 2px solid black;
  z-index: 9999;
  width: 80%;
  max-width: 800px;
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

.overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9998;
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
</style>
</head>
<body>

<!-- 画像をクリックするとポップアップ -->
<img src="../images/pika.png" alt="ピカチュウ" onclick="openPopup()" width="100px" style="aspect-ratio: 1/1; object-fit: cover;">

<!-- ポップアップウィンドウ -->
<div class="overlay" onclick="closePopup()"></div>
<div class="popup" id="popup">
  <div class="popup-content">
    <img src="../images/pika.png" alt="ピカチュウ">
    <div class="text-content">
      <div>
        <div class="user-info">
          <img src="../images/normal_icon.png" alt="ユーザーアイコン">
          <a href="#" id="username">太郎</a>
        </div>
        <div class="description">
          <p id="description">これはポップアップウィンドウの説明文です。</p>
        </div>
        <div class="comments">
          <strong>コメント:</strong>
          <ul id="commentList">
            <li>コメント1</li>
            <li>コメント2</li>
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
<div class="overlay" onclick="closeCommentPopup()"></div>
<div class="comment-popup" id="commentPopup">
  <form id="commentForm">
    <label for="name">名前:</label>
    <input type="text" id="name" name="name" required>
    <label for="comment">コメント:</label>
    <textarea id="comment" name="comment" rows="4" required></textarea>
    <button type="submit">送信</button>
  </form>
</div>

<script>
function openPopup() {
  document.getElementById("popup").style.display = "block";
  document.getElementsByClassName("overlay")[0].style.display = "block";
}

function closePopup() {
  document.getElementById("popup").style.display = "none";
  document.getElementsByClassName("overlay")[0].style.display = "none";
}

function openCommentPopup() {
  document.getElementById("commentPopup").style.display = "block";
  document.getElementsByClassName("overlay")[1].style.display = "block";
}

function closeCommentPopup() {
  document.getElementById("commentPopup").style.display = "none";
  document.getElementsByClassName("overlay")[1].style.display = "none";
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
  closeCommentPopup();
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
