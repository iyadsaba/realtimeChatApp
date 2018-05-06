

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <title>Chat Room</title>
</head>
<body>
    <h1 class="text-center"> Chat Room <i class="fa fa-comments"></i></h1>


    <div id="app">
        <div class="container clearfix">
            <chat-sidebar :users="users" :rooms="groups"></chat-sidebar>
            <div class="chat">
                <chat-room :messages="messages"></chat-room>
                <chat-composer v-on:typing="typing" v-on:sendMessage="sendMessage"></chat-composer>
            </div>
        </div>
    </div>

    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script>
        var socket = io('http://localhost:3000');
    </script>
    <script src="js/app.js" charset="utf-8"></script>
</body>
</html>