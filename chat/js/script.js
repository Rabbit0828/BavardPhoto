$(document).ready(function() {
    function loadMessages() {
        $.ajax({
            url: 'load_messages.php',
            method: 'GET',
            success: function(data) {
                $('#chat-box').html(data);
            }
        });
    }

    $('#send-button').click(function() {
        var message = $('#message-input').val();
        if (message.trim() !== '') {
            $.ajax({
                url: 'send_message.php',
                method: 'POST',
                data: { message: message },
                success: function() {
                    $('#message-input').val('');
                    loadMessages();
                }
            });
        }
    });

    setInterval(loadMessages, 1000);  // Fetch messages every second
});
