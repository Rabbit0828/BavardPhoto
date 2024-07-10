// chat_update.js
$(document).ready(function() {
    function updateChatHistory() {
        $.ajax({
            url: 'chat_message.php',
            method: 'GET',
            success: function(response) {
                console.log(response);
                $('#chat-history').html(response);
            }
        });
    }

    // 3秒ごとにチャット履歴を更新
    setInterval(updateChatHistory, 3000); 
});




