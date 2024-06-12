<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>フジカワらイヤーズ</title>
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

    </body>
</html>
