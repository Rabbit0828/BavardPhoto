<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require '../HeaderFile/header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="G2-1.css">
<title>画像の下にポップアップ</title>

</head>
<body>
<?php
try {
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);
    // エラーモードを例外に設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQLクエリの作成
    $sql = "SELECT * FROM Post";

    // プリペアドステートメントの作成
    $stmt = $pdo->prepare($sql);

    // クエリの実行
    $stmt->execute();

    // データのフェッチ
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($posts) {
        foreach ($posts as $result) {
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
            ?>

            <div class="popup" id="Post<?php echo $image_id; ?>">
                <div class="popup-content" data-image-id="<?php echo $image_id; ?>">
                    <!-- PHPで取得した画像のパスを表示 -->
                    <div class="slide-container">
                        <?php if (!empty($image_name)) echo '<img src="../images/' . htmlspecialchars($image_name) . '" alt="No.1">'; ?>
                        <?php if (!empty($image_name2)) echo '<img src="../images/' . htmlspecialchars($image_name2) . '" alt="No.2">'; ?>
                        <?php if (!empty($image_name3)) echo '<img src="../images/' . htmlspecialchars($image_name3) . '" alt="No.3">'; ?>
                        <?php if (!empty($image_name4)) echo '<img src="../images/' . htmlspecialchars($image_name4) . '" alt="No.4">'; ?>
                        <a class="prev" onclick="plusSlides(-1, <?php echo $image_id; ?>)">❮</a>
                        <a class="next" onclick="plusSlides(1, <?php echo $image_id; ?>)">❯</a>
                    </div>
                    <div class="text-content">
                        <div>
                            <div class="user-info">
                                <?php echo '<img src="../images/' . htmlspecialchars($user_icon) . '" alt="ユーザーアイコン" class="user-icon">'; ?>
                                <a href="../G4-1/profile.php?id=<?php echo $user_id; ?>" id="username"><?php echo $user_name; ?></a>
                            </div>
                            <div class="description">
                                <!-- PHPで取得したコメントを表示 -->
                                <p id="description"><?php echo htmlspecialchars($comment); ?></p>
                            </div>
                            <div class="comments">
                                <strong>コメント:</strong>
                                <ul id="commentList<?php echo $image_id; ?>">
                                    <?php foreach ($comments as $comment) : ?>
                                        <li>
                                            <div class="comment-item">
                                                <?php echo '<img src="../images/' . htmlspecialchars($comment['icon']) . '" alt="ユーザーアイコン" style="width: 40px;">'; ?>
                                                <strong><?php echo htmlspecialchars($comment['user_name']); ?>:</strong>
                                                <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                        <div class="button-group">
                            <button class="like-button" onclick="like(<?php echo $image_id; ?>)"></button>
                            <span class="count"><?php echo $like_count; ?></span>
                            <button class="bookmark-button" onclick="bookmark(<?php echo $image_id; ?>)"></button>
                            <button class="comment-button" onclick="openCommentPopup()"></button>
                            <span class="count"><?php echo $comment_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        echo "No data found.";
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<!-- コメント用ポップアップウィンドウ -->
<div class="comment-popup" id="commentPopup">
    <form>
        <label for="comment">コメント:</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>
        <button type="button" onclick="submitComment()">送信</button>
    </form>
</div>

<script>
    const slideIndices = {};

    document.querySelectorAll('.popup-content').forEach((popup, index) => {
        const container = popup.querySelector('.slide-container');
        slideIndices[index] = 1;
        showSlides(1, container, index);
    });

    function plusSlides(n, imageId) {
        const container = document.querySelector(`.popup-content[data-image-id="${imageId}"] .slide-container`);
        const index = Array.prototype.indexOf.call(container.parentNode.children, container);
        showSlides(slideIndices[index] += n, container, index);
    }

    function showSlides(n, container, index) {
        const slides = container.querySelectorAll('img');
        if (n > slides.length) { slideIndices[index] = 1 }
        if (n < 1) { slideIndices[index] = slides.length }
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[slideIndices[index] - 1].style.display = "block";
    }

    function like(imageId) {
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
                    const likeCountElement = document.querySelector(`.popup-content[data-image-id="${imageId}"] .like-button + .count`);
                    if (likeCountElement) {
                        likeCountElement.textContent = data.like_count;
                    }
                } else {
                    console.error('いいねの処理に失敗しました:', data.error);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function bookmark(imageId) {
        fetch('bookmark.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ image_id: imageId })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Post has been bookmarked.');
                } else {
                    console.error('Failed to bookmark the post:', data.error);
                }
            })
            .catch(error => console.error('Error:', error));
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
                    const commentList = document.getElementById('commentList' + imageId);
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
