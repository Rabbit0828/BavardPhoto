const slideIndices = {};

document.querySelectorAll('.popup-content').forEach((popup, index) => {
    const container = popup.querySelector('.slide-container');
    slideIndices[index] = 1;
    showSlides(1, container, index);
});

function plusSlides(n, imageId) {
    const container = document.querySelector(`#Post${imageId} .slide-container`);
    showSlides(slideIndices[imageId] += n, container, imageId);
}

function showSlides(n, container, imageId) {
    const slides = container.getElementsByTagName('img');
    if (n > slides.length) {
        slideIndices[imageId] = 1;
    }
    if (n < 1) {
        slideIndices[imageId] = slides.length;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    slides[slideIndices[imageId] - 1].style.display = 'block';
}

function submitWithImageId(imageId) {
    document.getElementById('imageId').value = imageId;
    document.getElementById('commentPopup').style.display = 'block';
}

function closeCommentPopup() {
    document.getElementById('commentPopup').style.display = 'none';
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
                <img src="../images/${data.user_icon}" alt="ユーザーアイコン" class="user-icon" style="border-radius: 50%; width:35px;">
                <strong>${data.user_name}:</strong>
                <p>${data.comment}</p>
            </div>`;
            commentList.appendChild(newComment);

            document.getElementById('comment').value = '';
            document.getElementById('commentPopup').style.display = 'none';
        } else {
            console.error('コメントの送信に失敗しました:', data.error);
        }
    })
    .catch(error => console.error('エラー:', error));
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

            // Toggle like button style
            if (likeButton.classList.contains('liked')) {
                likeButton.classList.remove('liked');
            } else {
                likeButton.classList.add('liked');
            }
        } else {
            console.error('Failed to like the image');
        }
    })
    .catch(error => console.error('Error:', error));
}
