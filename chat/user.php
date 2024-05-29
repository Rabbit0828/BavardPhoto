<?php
     const SERVER = 'mysql304.phy.lolipop.lan';
     const DBNAME = 'LAA1517469-photos';
     const USER ='LAA1517469';
     const PASS ='Pass1234';
     
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>
  <!DOCTYPE html>
  <html lang="ja">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/itiran.css">
        <title>ユーザー</title>
</head>
<body>
    <h1>ユーザー</h1>
    <?php
    $pdo=new PDO($connect,USER,PASS);
    echo"<table><th>ユーザーid</th><th>ユーザー名</th>";
    foreach($pdo->query('select * from UserTable') as $row){
        echo '<tr>';
        echo '<td>', $row['user_id'],'</td>';
        echo '<td>', $row['user_name'],'</td>';
        echo "\n";
    }
    echo"</table>";
    ?>
    
    </body>
</html>