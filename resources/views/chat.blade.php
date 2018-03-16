

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
        <div class="container">
            <div class="row">
                <div class="col-md-2 "></div>
                <div class="col-md-8 col-xs-12">
                    <chat-message></chat-message>
                    <chat-log :messages="messages"></chat-log>
                    <chat-composer v-on:messagesent="addMessage"></chat-composer>
                </div>
                <div class="col-md-2 "></div>

            </div>

        </div>
     
    </div>

    <script src="js/app.js" charset="utf-8"></script>
</body>
</html>