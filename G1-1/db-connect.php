<?php
     const SERVER = 'mysql304.phy.lolipop.lan';
     const DBNAME = 'LAA1517469-sistem';
     const USER ='LAA1517469';
     const PASS ='Pass1234';
     
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
    $pdo=new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1517469-sistem;charset=utf8','LAA1517469','Pass1234');

?>