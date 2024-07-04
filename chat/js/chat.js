$(document).ready(function() {
    function loadMessages() {
        $.ajax({
            url: 'load_messages.php',
            method: 'GET',
            data: { user_id: $('input[name="chat_user_id"]').val() },
            success: function(data) {
                $('#chat-box').html(data);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    }

    loadMessages();
    setInterval(loadMessages, 1000);

    $('#chat-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'send_message.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function() {
                $('textarea[name="message"]').val('');
                loadMessages();
            }
        });
    });
});



