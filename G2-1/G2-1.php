<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require '../HeaderFile/header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="G2-1.css">
<title>画像の下にポップアップ</title>
</head>
<body>
<div class="search-container">
    <form method="get">
        <input type="text" name="search" size="40" placeholder="キーワード検索" style="height: 40px;">
    </form>
</div>

<?php

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM Post WHERE image_id = :search OR user_id = :search OR user_name = :search";
} else {
    $sql = "SELECT * FROM Post";
}

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare($sql);

    if (isset($search)) {
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    }

    $stmt->execute();
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

            $user_name = $user_result ? $user_result['user_name'] : 'Unknown User';
            $user_icon = $user_result['icon'] ?? '';

            $comment_sql = "SELECT Comment.comment, UserTable.user_name, UserTable.icon
                            FROM Comment
                            JOIN UserTable ON Comment.user_id = UserTable.user_id
                            WHERE Comment.image_id = :image_id";
            $comment_stmt = $pdo->prepare($comment_sql);
            $comment_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
            $comment_stmt->execute();
            $comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

            $like_sql = "SELECT COUNT(*) AS like_count FROM Nice WHERE image_id = :image_id";
            $like_stmt = $pdo->prepare($like_sql);
            $like_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
            $like_stmt->execute();
            $like_count = $like_stmt->fetch(PDO::FETCH_ASSOC)['like_count'];

            $comment_count_sql = "SELECT COUNT(*) AS comment_count FROM Comment WHERE image_id = :image_id";
            $comment_count_stmt = $pdo->prepare($comment_count_sql);
            $comment_count_stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
            $comment_count_stmt->execute();
            $comment_count = $comment_count_stmt->fetch(PDO::FETCH_ASSOC)['comment_count'];
            ?>

            <div class="popup" id="Post<?php echo $image_id; ?>">
                <div class="popup-content" data-image-id="<?php echo $image_id; ?>">
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
                                <p id="description"><?php echo htmlspecialchars($comment); ?></p>
                            </div>
                            <div class="comments">
                                <strong>コメント:</strong>
                                <ul id="commentList<?php echo $image_id; ?>">
                                    <?php foreach ($comments as $comment) : ?>
                                        <li>
                                            <div class="comment-item">
                                                <?php echo '<img src="../images/' . htmlspecialchars($comment['icon']) . '" alt="ユーザーアイコン" class="user-icon" style="border-radius: 50%; width:35px;">'; ?>
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
                            <div class="container">
                                <a href="like_list.php?id=<?php echo $image_id; ?>" id="username" target="_self">
                                    <span class="count"><?php echo $like_count; ?></span>
                                </a>
                            </div>
                            <button class="comment-button" onclick="submitWithImageId(<?php echo $image_id; ?>)"></button>
                            <span class="count"><?php echo $comment_count; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "検索結果がありません。";
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<div class="comment-popup" id="commentPopup">
    <div class="comment-popup-content">
        <button class="close-btn" onclick="closeCommentPopup()">×</button>
        <h2>コメント送信</h2>
        <form id="commentForm">
            <textarea id="comment" name="comment" rows="4" required placeholder="コメントを入力してください"></textarea>
            <input type="hidden" id="imageId" name="image_id">
            <div class="button-container">
            <button type="button" class="submit-btn2" onclick="submitComment()"></button>
                <button type="button" class="submit-btn" onclick="submitComment()">
                <img src="../images/comment_sub.png" style="width:50px;" alt="送信">
                </button>

            </div>
        </form>
    </div>
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
        const likeButton = document.querySelector(`.popup-content[data-image-id="${imageId}"] .like-button`);
        const likeCountElement = document.querySelector(`.popup-content[data-image-id="${imageId}"] .like-button + .container .count`);

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
                likeCountElement.textContent = data.like_count;
            } else {
                console.error('Failed to like the image');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function submitWithImageId(imageId) {
        document.getElementById('imageId').value = imageId;
        document.getElementById('commentPopup').style.display = 'block';
    }

    function submitComment() {
        const comment = document.getElementById('comment').value;
        const imageId = document.getElementById('imageId').value;

        if (comment.trim() === '') {
            alert('コメントを入力してください。');
            return;
        }

        fetch('submit_comment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ image_id: imageId, comment: comment })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const commentList = document.getElementById(`commentList${imageId}`);
                const newComment = document.createElement('li');
                newComment.innerHTML = `<div class="comment-item">
                    <img src="../images/<?php echo $_SESSION['user_icon']; ?>" alt="ユーザーアイコン" class="user-icon" style="border-radius: 50%; width:35px;">
                    <strong><?php echo $_SESSION['user_name']; ?>:</strong>
                    <p>${comment}</p>
                </div>`;
                commentList.appendChild(newComment);

                document.getElementById('comment').value = '';
                document.getElementById('commentPopup').style.display = 'none';
            } else {
                console.error('Failed to submit comment');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    function closeCommentPopup() {
        document.getElementById('commentPopup').style.display = 'none';
    }
</script>

<!---<?php require '../HeaderFile/footer.php'; ?>--->
</body>
</html>
