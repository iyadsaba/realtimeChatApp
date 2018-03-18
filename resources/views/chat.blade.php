

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
        {{--  <div class="container">
            <div class="row">
                <div class="col-md-2 "></div>
                <div class="col-md-8 col-xs-12">
                    <chat-message></chat-message>
                    <chat-log :messages="messages"></chat-log>
                    <chat-composer v-on:messagesent="addMessage"></chat-composer>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>  --}}

        <chat-room></chat-room>
    </div>

   
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
      {{--  <script src="{{ asset('js/socket.io.js') }}"></script>  --}}
    <script>
        var socket = io('http://localhost:3000');
        // var socket = io('http://192.168.10.10:3000');
       
        // socket.on("test-channel:App\\Events\\EventName", function(message){
        //     // increase the power everytime we load test route
        //     // $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        // });
    </script>
    <script src="js/app.js" charset="utf-8"></script>
</body>
</html>