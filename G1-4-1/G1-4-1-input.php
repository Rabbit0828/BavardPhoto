<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>BavardPhotos</title>
    </head>
    <body>
        
    <div class="logo">
        <a href="../G2-1/G2-1.php">
        <button><img src="../images/button.png" alt="ロゴ"></button>
        </a>
    </div>

    <div class="logout">
        <h2>本当にログアウトしますか</h2>
    </div>

    <form action="G1-4-1-output.php" method="post">
        <button type="submit">はい</button>
    </form>

    <a href="../G2-1/G2-1.php"><button type="submit">いいえ</button></a>

    </body>
</html>

<style>
/* styles.css */

/* Reset some default styles */
body, h2, button, a {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

/* Style the body */
body {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    position: relative; /* Add this line */
}

/* Style the logo */
.logo {
    position: absolute; /* Add this line */
    top: 0; /* Add this line */
    left: 0; /* Add this line */
    margin: 20px; /* Optional: adjust margin as needed */
}

.logo button {
    background: none;
    border: none;
}

.logo img {
    width: 100px; /* Adjust the size as needed */
    height: auto;
}

/* Style the logout message */
.logout h2 {
    color: #333;
    margin-bottom: 20px;
}

/* Style the form buttons */
form, a {
    margin-bottom: 10px;
}

button {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #0056b3;
}

/* Style the "いいえ" button separately */
a button {
    background-color: #6c757d;
}

a button:hover {
    background-color: #5a6268;
}

</style>