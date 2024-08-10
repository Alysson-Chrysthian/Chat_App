<script>
    const chat = document.getElementById('chat');
    const message = document.getElementById('message');
    const sendButton = document.querySelector('button');

    const conn = new WebSocket('ws://localhost:8080');

    conn.onopen = function (e) {
        console.log("connection established");
    }

    conn.onmessage = function (e) {
        console.log(e.data);
    };

</script>