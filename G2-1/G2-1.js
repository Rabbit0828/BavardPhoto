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