<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>BavardPhotos</title>
        <style>
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin: 0;
                height: 100vh;
            }

            .logo {
                margin-top: 20px; /* Adjusts the top margin of the logo */
            }

            .content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                flex: 1;
            }
            
            .welcome {
                margin-bottom: 5vh;
            }

            .welcome button {
                font-size: 45px; /* Increases the size of the text */
                padding: 15px 30px; /* Increases the size of the button */
                border-radius: 50px; /* 丸角の大きさ */
                background-color: #DC34E0; /* Sets the background color */
                color: white; /* Sets the text color */
                border: none; /* Removes the default border */
                cursor: pointer; /* Changes the cursor to a pointer on hover */
            }
            
            .welcome button:hover {
                background-color: #45a049; /* Changes the background color on hover */
            }
            
            .kura img {
                width: 300px; /* Adjust the width to your preference */
                height: auto; /* Maintains the aspect ratio */
            }

            .sparkle {
                position: absolute;
                width: 5px;
                height: 5px;
                background-color: rgb(213, 15, 15);
                box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
                border-radius: 50%;
                opacity: 0;
                animation: sparkle 1s linear infinite;
            }

            @keyframes sparkle {
            0% {
                transform: translateY(0) scale(0);
                opacity: 1;
            }
            50% {
                transform: translateY(-10vh) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateY(-20vh) scale(0);
                opacity: 0;
            }
        }

            
        </style>
    </head>
    <body>
        
    <div class="logo">
        <img src="../images/logo.png" alt="ロゴ">
    </div>

    <div class="content">
        <div class="welcome">
            <a href="../G1-1/G1-1-input.php">
                <button type="submit">WELCOME</button>
            </a>
        </div>

        <div class="kura">
            <img src="../images/kk.png">
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
            const sparkleCount = 99; // キラキラの数
            const body = document.body;

            for (let i = 0; i < sparkleCount; i++) {
                const sparkle = document.createElement("div");
                sparkle.className = "sparkle";
                sparkle.style.left = `${Math.random() * 100}vw`;
                sparkle.style.top = `${Math.random() * 100}vh`;
                sparkle.style.animationDelay = `${Math.random() * 2}s`;
                body.appendChild(sparkle);
            }
        });
    </script>

    </body>
</html>
