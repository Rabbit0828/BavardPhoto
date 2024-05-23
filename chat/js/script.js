document.addEventListener('DOMContentLoaded', (event) => {
    const chatForm = document.getElementById('chat-form');
    const chatBox = document.getElementById('chat-box');

    // メッセージ送信処理
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const username = document.getElementById('username').value;
        const message = document.getElementById('message').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'php/send_message.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('message').value = '';
                fetchMessages();
            }
        };
        xhr.send('username=' + username + '&message=' + message);
    });

    // メッセージ取得処理
    function fetchMessages() {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'php/fetch_messages.php', true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                const messages = JSON.parse(xhr.responseText);
                chatBox.innerHTML = '';
                messages.forEach(function(message) {
                    const messageElement = document.createElement('div');
                    messageElement.textContent = `${message.username}: ${message.message} (${message.timestamp})`;
                    chatBox.appendChild(messageElement);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };
        xhr.send();
    }

    // 定期的にメッセージを取得
    setInterval(fetchMessages, 1000);
    fetchMessages();
});
