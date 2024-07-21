$(document).ready(function() {
    function updateChatHistory() {
        const url = new URL(window.location.href);
        const params = url.searchParams;
        const recipient_id = params.get('user_id'); 

        $.ajax({
            url: 'chat_message.php',
            method: 'GET',
            data: { user_id: recipient_id },
            success: function(response) {
                $('#chat-history').html(response);
            }
        });
    }

    setInterval(updateChatHistory,1000); 
});
