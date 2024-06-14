<?php
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-photos';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

$connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';

try {
    $pdo = new PDO($connect, USER, PASS);
    // PDOオブジェクトの設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // エラーモードを設定
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // プリペアドステートメントのエミュレーションを無効化
} catch (PDOException $e) {
    // エラーメッセージを表示して終了
    die("データベース接続エラー: " . $e->getMessage());
}
?>
