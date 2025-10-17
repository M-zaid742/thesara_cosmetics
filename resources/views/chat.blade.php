<div id="chatbox">
    <div id="messages"></div>
    <input id="message" type="text">
    <button onclick="sendMessage()">Send</button>
</div>
<script>
function sendMessage() {
    let msg = document.getElementById('message').value;
    fetch('/chatbot', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ message: msg })
    }).then(res => res.json()).then(data => {
        document.getElementById('messages').innerHTML += `<p>User: ${msg}</p><p>Bot: ${data.reply}</p>`;
    });
}
</script>