<?php
     const SERVER = 'mysql304.phy.lolipop.lan';
     const DBNAME = 'LAA1517469-photos';
     const USER ='LAA1517469';
     const PASS ='Pass1234';
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
    $pdo=new PDO($connect,USER,PASS);
?>