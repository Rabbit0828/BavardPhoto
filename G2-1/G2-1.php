<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Instagram-like Homepage</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  header {
    background-color: #fff;
    padding: 10px 20px;
    border-bottom: 1px solid #ccc;
    display: flex;
    align-items: center;
  }
  header img {
    height: 30px;
    margin-right: 10px;
  }
  header h1 {
    font-size: 24px;
    margin: 0;
  }
  .container {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 20px;
  }
  .post {
    border: 1px solid #ccc;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #fff;
    display: flex;
  }
  .post .left {
    width: 50%;
    padding-right: 10px;
    box-sizing: border-box;
    cursor: pointer;
  }
  .post .right {
    width: 50%;
    padding-left: 10px;
    box-sizing: border-box;
    cursor: pointer;
  }
  .post img {
    width: 100%;
  }
  .post .author {
    font-weight: bold;
    margin-bottom: 5px;
  }
  .post .description {
    margin-bottom: 10px;
  }
  .post .comments {
    font-size: 14px;
  }
</style>
</head>
<body>

<header>
  <img src="instagram-logo.png" alt="Instagram Logo">
  <h1>Instagram-like Homepage</h1>
</header>

<div class="container">
  <div class="post">
    <div class="left" onclick="prevImage()">
      <div class="author">John Doe</div>
      <img id="profile1" src="../images/giratina.png" alt="Profile Picture">
    </div>
    <div class="right" onclick="nextImage()">
      <div class="description">Beautiful sunset! 🌅</div>
      <div class="comments">
        <div><strong>User1:</strong> Stunning view!</div>
        <div><strong>User2:</strong> I love it!</div>
      </div>
    </div>
  </div>
</div>

<script>
  var images = ['../images/milyuu.png', '../images/pika.png', '../images/rugia.png', '../images/giratina.png'];
  var currentIndex = 0;

  function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    document.getElementById('profile1').src = images[currentIndex];
  }

  function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    document.getElementById('profile1').src = images[currentIndex];
  }
</script>
</body>
</html>