<?php
// 定数の定義
const SERVER = 'mysql304.phy.lolipop.lan';
const DBNAME = 'LAA1517469-sistem';
const USER = 'LAA1517469';
const PASS = 'Pass1234';

try {
    // データベース接続文字列
    $connect = 'mysql:host=' . SERVER . ';dbname=' . DBNAME . ';charset=utf8';
    
    // PDOインスタンスの作成
    $pdo = new PDO($connect, USER, PASS);

    // PDOエラーモードの設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected successfully"; // 接続成功メッセージ
} catch (PDOException $e) {
    // 接続失敗時のエラーメッセージ
    echo "Connection failed: " . $e->getMessage();
}
?>
