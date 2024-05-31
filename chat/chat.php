<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
    ・・・
    <link type="text/css" rel="stylesheet" href="css/bmesse.css" />
</head>

    <title>チャットサンプル</title>
</head>
<body>
    <!-- 自分やユーザーの情報 -->
    <h3 id="me" user_id="1">あなたはユーザー1です</h3>
    <h3 id="partner" thread_id="1">相手</h3>
    <div id="users">
        <button class="user" user_id="2">ユーザー2</button>
    </div>
    <br>
    <div id="your_container">

        <!-- チャットの外側部分① -->
        <div id="bms_messages_container">
            <!-- ヘッダー部分② -->
            <div id="bms_chat_header">
                <!--ステータス-->
                <div id="bms_chat_user_status">
                    <!--ステータスアイコン-->
                    <div id="bms_status_icon">●</div>
                    <!--ユーザー名-->
                    <div id="bms_chat_user_name">ユーザー</div>
                </div>
            </div>

            <!-- タイムライン部分③ -->
            <div id="bms_messages">

                <!--メッセージ１（左側）-->
                <div class="bms_message bms_left">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">ほうほうこりゃー便利じゃないか</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->

                <!--メッセージ２（右側）-->
                <div class="bms_message bms_right">
                    <div class="bms_message_box">
                        <div class="bms_message_content">
                            <div class="bms_message_text">うん、まあまあいけとるな</div>
                        </div>
                    </div>
                </div>
                <div class="bms_clear"></div><!-- 回り込みを解除（スタイルはcssで充てる） -->
            </div>

            <!-- テキストボックス、送信ボタン④ -->
            <div id="bms_send">
                <textarea id="bms_send_message"></textarea>
                <div id="bms_send_btn">送信</div>
            </div>
        </div>
    </div>
</body>
</html>