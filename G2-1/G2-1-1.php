<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require '../HeaderFile/header.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="G2-1.css">
<title>画像の下にポップアップ</title>
</head>
<body>


<?php

      $image_id = isset($_GET['image_id']) ? intval($_GET['image_id']) : 0;

        if ($image_id == 0) {
            echo '画像IDが無効です。';
            exit;
        }


try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM Post WHERE image_id = :image_id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':image_id' => $image_id]);
    $post = $stmt->fetch();

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
            
            // Check if the logged-in user has liked this post
            $check_like_sql = "SELECT COUNT(*) FROM Nice WHERE image_id = ? AND user_id = ?";
            $check_like_stmt = $pdo->prepare($check_like_sql);
            $check_like_stmt->execute([$image_id, $_SESSION['UserTable']['id']]);
            $liked_by_user = (bool) $check_like_stmt->fetchColumn();

            ?>

            <div class="popup" id="Post<?php echo $image_id; ?>">
                <div class="popup-content" data-image-id="<?php echo $image_id; ?>">
                    <div class="slide-container">
                        <?php if (!empty($image_name)) echo '<img src="../images/' . htmlspecialchars($image_name) . '" alt="No.1" onclick="openModal(this.src)">'; ?>
                        <?php if (!empty($image_name2)) echo '<img src="../images/' . htmlspecialchars($image_name2) . '" alt="No.2" onclick="openModal(this.src)">'; ?>
                        <?php if (!empty($image_name3)) echo '<img src="../images/' . htmlspecialchars($image_name3) . '" alt="No.3" onclick="openModal(this.src)">'; ?>
                        <?php if (!empty($image_name4)) echo '<img src="../images/' . htmlspecialchars($image_name4) . '" alt="No.4" onclick="openModal(this.src)">'; ?>
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
                        <button class="like-button" onclick="like(<?php echo $image_id; ?>)" id="likeButton<?php echo $image_id; ?>">
                            <?php if ($liked_by_user) : ?>
                                <script>
                                    document.getElementById('likeButton<?php echo $image_id; ?>').classList.add('liked');
                                </script>
                            <?php endif; ?>
                        </button>

                            <div class="container">
                                <a href="like_list.php?id=<?php echo $image_id; ?>" id="username" target="_self">
                                    <span class="count"><?php echo $like_count; ?></span>
                                </a>
                            </div>
                            <button class="comment-button" onclick="submitWithImageId(<?php echo $image_id; ?>)">
                            <img src="../images/comment.png" alt="Comment">
                            </button>
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

<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
    <div id="caption"></div>
</div>

<div class="comment-popup" id="commentPopup">
    <div class="comment-popup-content">
        <button class="close-btn" onclick="closeCommentPopup()">×</button>
        <h2>コメント送信</h2>
        <form id="commentForm">
            <textarea id="comment" name="comment" rows="4" required placeholder="コメントを入力してください"></textarea>
            <input type="hidden" id="imageId" name="image_id">
            <div class="button-container">
                <button type="button" class="submit-btn" onclick="submitComment()">
                    <img src="../images/comment_sub.png" style="width:50px;" alt="送信">
                </button>
            </div>
        </form>
    </div>
</div>

<img src="../images/back_page.png" alt="Image" onclick="goBack()" style="width:100px" />

<script>
function goBack() {
    window.history.back();
}
</script>

<script>
    const userIcon = <?php echo json_encode($_SESSION['UserTable']['icon']); ?>;
    const userName = <?php echo json_encode($_SESSION['UserTable']['name']); ?>;

    function openModal(src) {
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        modal.style.display = "block";
        modalImg.src = src;
    }

    function closeModal() {
        const modal = document.getElementById("imageModal");
        modal.style.display = "none";
    }
</script>
<script src="G2-1.js"></script>

<!---<?php require '../HeaderFile/footer.php'; ?>--->
</body>
</html>