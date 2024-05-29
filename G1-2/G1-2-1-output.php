<?php
session_start();

unset($_SESSION['UserTable']);
$pdo=new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1517469-photos;charset=utf8',
'LAA1517469','Pass1234');

if(isset($_SESSION['UserTable'])) {
    $id=$_SESSION['UserTable']['user_id'];
    $sql=$pdo->prepare('select * from UserTable where user_id!=? and user_name=?');
    $sql->execute([$id,$_POST['user_name']]);
} else {
    $sql=$pdo->prepare('select * from user_data where user_name=? ');
    $sql->execute([$_POST['user_name']]);
}

if(empty($sql->fetchAll())) {
        if(!isset($_SESSION['UserTable'])) {
            $sql=$pdo->prepare('insert into UserTable (user_name,password,mail_address,tell) value(?,?,?,?)');
                $sql->execute([
                    $_POST['user_name'],
                    $_POST['password'],
                    $_POST['mail_address'],
                    $pass,$_POST['tell']]);

                    $_SESSION['UserTable'] = [
                        'user_name' => $_POST['user_name'],
                        'password' => $_POST['password'],
                        'mail_address' => $_POST['mail_address'],
                        'tell' => $_POST['tell']
                    ];

                    echo '登録しました。';
            }
        } else {
            echo 'ユーザーネームがすでに使用されていますので、変更してください。';
    }
    
        
?>