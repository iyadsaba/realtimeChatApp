var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');
var redis = new Redis();



redis.subscribe('channel-name', function(err, count) {


});

redis.on('message', function(channel, message) {

    console.log('Message Received: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});



var usersCount = 0;
var allUsers = [];

io.on('connection', function (socket) {
    console.log("connection was made");

    socket.on('textMessage', function (data, room) {
        //adding data type as message to the data
        data.type = "messgae";
        socket.to(room).emit('textMessage', data);
    });

    socket.on('addUser', function (user) {
        ++usersCount;
        io.sockets.emit('onlineUsers', usersCount);
    });

    // socket.on("typing",function(){
    //     socket.emit('room1','typing');
    // })

    socket.on('joinRoom', function (roomName, userName) {
        console.log(`User Joined Room : ${roomName}`);
        socket.join(roomName);
        // let data = {}
        // io.sockets.emit('onlineUsers',data);
    });

    socket.on('leaveRoom', function (roomName, userName) {
        console.log(`User Leaved Room : ${roomName}`);
        socket.leave(roomName);
    });


    socket.on('disconnect', function () {
        console.log('user disconnected');
        --usersCount;
        io.sockets.emit('onlineUsers', usersCount);
    });
});



http.listen(3000, function(){
    console.log('Listening on Port 3000');
});