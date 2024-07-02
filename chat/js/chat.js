$(document).ready(function() {
    // メッセージ送信
    $('#bms_send_btn').click(function() {
        var message = $('#bms_send_message').val();
        if (message.trim() !== '') {
            $.ajax({
                url: 'send_message.php',
                type: 'POST',
                data: { message: message },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status === 'success') {
                        $('#bms_messages').append(
                            '<div class="bms_message bms_right">' +
                            '<div class="bms_message_box">' +
                            '<div class="bms_message_content">' +
                            '<div class="bms_message_text">' + message + '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div><div class="bms_clear"></div>'
                        );
                        $('#bms_send_message').val('');
                        $('#bms_messages').scrollTop($('#bms_messages')[0].scrollHeight); // 自動スクロール
                    }
                },
                error: function() {
                    // エラー時の処理を空にすることでアラートが表示されなくなります
                }
            });
        }
    });

    // メッセージ取得
    function fetchMessages() {
        $.ajax({
            url: 'get_messages.php',
            type: 'GET',
            success: function(response) {
                var messages = JSON.parse(response);
                $('#bms_messages').html('');
                messages.forEach(function(msg) {
                    var alignment = (msg.user === 'あなた') ? 'bms_right' : 'bms_left';
                    $('#bms_messages').append(
                        '<div class="bms_message ' + alignment + '">' +
                        '<div class="bms_message_box">' +
                        '<div class="bms_message_content">' +
                        '<div class="bms_message_text">' + msg.message + '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div><div class="bms_clear"></div>'
                    );
                });
                $('#bms_messages').scrollTop($('#bms_messages')[0].scrollHeight); // 自動スクロール
            },
            error: function() {
                // エラー時の処理を空にすることでアラートが表示されなくなります
            }
        });
    }

    // 定期的にメッセージを取得
    setInterval(fetchMessages, 3000); // 3秒ごとにメッセージを取得
});

