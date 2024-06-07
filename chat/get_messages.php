<?php
// ダミーデータを返す
$messages = [
    ['user' => 'ユーザー2', 'message' => 'ほうほうこりゃー便利じゃないか'],
    ['user' => 'あなた', 'message' => 'うん、まあまあいけとるな']
];
echo json_encode($messages);
?>
