<?php
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-sistem';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

try {
    $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

