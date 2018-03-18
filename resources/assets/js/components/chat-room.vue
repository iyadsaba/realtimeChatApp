<template>

    <div id="chat" class='container'>
        <h1>{{ room === "" ? "VueJs Messenger App": room}}</h1>
       
        <form v-if="!showChat" @submit.prevent="loginWithNewUser">
            <input type="text" v-model="name" placeholder="NickName">
            <button type="submit">Login</button>
        </form>
       
        <h4 v-if="userInputEmpty">User Can't be Empty ! </h4>
       <div class='chatbox' v-if="showChat">
            <div class='chatbox__user-list'>
              <h1>Groups/Users ({{ online }})</h1>
                <div v-for="r in rooms" v-bind:class='r == room ? "chatbox__user--active" : "chatbox__user--busy"' @click="joinRoom(r)">
                    <p>{{ r }} </p>
                </div>
            </div>
    
            <div class="chatbox__messages">
                <div class="chatbox__messages__user-message">
                    <div class="chatbox__messages__user-message--ind-message" v-for="message in messages">
                        <p class="name">{{message.user}}</p>
                        <br/>
                        <p class="message">{{message.text}}</p>
                    </div>
                </div>
            </div>

            <form @submit.prevent="send">
                <input type="text" v-on:keyup="typing" v-model="text" placeholder="Type Message">
            </form>
        </div>
    </div>    
  
</template>


<script>
export default {
  data() {
    return {
      rooms: [
        "General",
        "Private Room",
        "Grils Only ",
        "Boys Only ",
        "Men Only ",
        "Kids"
      ],
      isTyping: false,
      messages: [
      {
        text:'some text',
        user:"iyad"
      },
      {
        text:'some text',
        user:"iyad"
      },
      {
        text:'some text',
        user:"iyad"
      }
      ],
      text: "",
      room: "",
      showChat: false,
      name: "",
      online: 0,
      userInputEmpty: false
    };
  },
  created: function() {
    socket.on(
      "textMessage",
      function(data) {
        console.log(data);
        this.messages.push(data);
      }.bind(this)
    );

    socket.on(
      "onlineUsers",
      function(data) {
        this.online = data;
        console.log(data);
      }.bind(this)
    );
  },
  methods: {
    send: function() {
      let data = {
        text: this.text,
        user: this.name
      };
      socket.emit("textMessage", data, this.room);
      this.messages.push(data);
      this.text = "";
      this.isTyping = false;
    },
    typing: function() {
      if (this.isTyping == false) {
        this.isTyping = true;
        socket.emit("room1", "typing");
      }
    },
    joinRoom: function(roomName) {
      //clear all messages when joining new room or switching between rooms
      this.messages = [];
      if (this.room) {
        socket.emit("leaveRoom", roomName, this.name);
      }
      socket.emit("joinRoom", roomName, this.name);
      this.room = roomName;
    },
    loginWithNewUser: function() {
      if (this.addUser()) {
        this.joinRoom("General");
        this.showChat = true;
      }
    },
    addUser: function() {
      if (this.user == "") {
        this.userInputEmpty = true;
        return false;
      }
      socket.emit("addUser", this.user);
      return true;
    }
  }
}
</script>


<style scoped>

 .cp-pen-styles {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Nunito', sans-serif;
} 

html,
body {
  background: -webkit-linear-gradient(330deg, #000, #f0a6ca);
  background: linear-gradient(120deg, #000, #f0a6ca);
  overflow: hidden;
}

.container {
  background: -webkit-linear-gradient(330deg, #000, #f0a6ca);
  background: linear-gradient(120deg, #000, #f0a6ca);
  overflow: hidden;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  height: 106vh;
  width: 100vw;
}

.container h1 {
  margin: 0.5em auto;
  color: #fff;
  text-align: center;
}

.chatbox {
  background: rgba(255, 255, 255, 0.05);
  width: 600px;
  height: 75%;
  border-radius: 0.2em;
  position: relative;
  box-shadow: 1px 1px 12px rgba(0, 0, 0, 0.1);
}

.chatbox__messages:nth-of-type(odd)
  .chatbox__messages__user-message--ind-message {
  float: right;
}

.chatbox__messages:nth-of-type(odd)
  .chatbox__messages__user-message--ind-message:after {
  content: "";
  position: absolute;
  margin: -1.5em -17.06em;
  width: 0;
  height: 0;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-right: 10px solid rgba(255, 255, 255, 0.2);
}

.chatbox__messages:nth-of-type(even)
  .chatbox__messages__user-message--ind-message {
  float: left;
}

.chatbox__messages:nth-of-type(even)
  .chatbox__messages__user-message--ind-message:after {
  content: "";
  position: absolute;
  margin: -1.5em 1.87em;
  width: 0;
  height: 0;
  border-top: 10px solid transparent;
  border-bottom: 10px solid transparent;
  border-left: 10px solid rgba(255, 255, 255, 0.2);
}

.chatbox__messages__user-message {
  width: 450px;
}

.chatbox__messages__user-message--ind-message {
  background: rgba(255, 255, 255, 0.2);
  padding: 1em 0;
  height: auto;
  width: 65%;
  border-radius: 5px;
  margin: 2em 1em;
  overflow: auto;
}

.chatbox__messages__user-message--ind-message > p.name {
  color: #fff;
  font-size: 1em;
}

.chatbox__messages__user-message--ind-message > p.message {
  color: #fff;
  font-size: 0.7em;
  margin: 0 2.8em;
}

.chatbox__user-list {
  background: rgba(255, 255, 255, 0.1);
  width: 25%;
  height: 100%;
  float: right;
  border-top-right-radius: 0.2em;
  border-bottom-right-radius: 0.2em;
}

.chatbox__user-list h1 {
  background: rgba(255, 255, 255, 0.05);
  color: rgba(255, 255, 255, 0.9);
  font-size: 0.9em;
  padding: 1em;
  margin: 0;
  font-weight: 300;
  text-align: center;
}

.chatbox__user,
.chatbox__user--active,
.chatbox__user--busy,
.chatbox__user--away {
  width: 0.5em;
  height: 0.5em;
  border-radius: 100%;
  margin: 1em 0.7em;
}

.chatbox__user--active {
  background: rgba(23, 190, 187, 0.8);
}

.chatbox__user--busy {
  background: rgba(252, 100, 113, 0.8);
}

.chatbox__user--away {
  background: rgba(255, 253, 130, 0.8);
}

.chatbox p {
  float: left;
  text-align: left;
  margin: -0.25em 2em;
  font-size: 0.7em;
  font-weight: 300;
  color: #fff;
  width: 200px;
}

.chatbox form {
  background: #222;
}

.chatbox form input {
  background: rgba(255, 255, 255, 0.03);
  position: absolute;
  bottom: 0;
  left: 0;
  border: none;
  width: 75%;
  padding: 1.2em;
  outline: none;
  color: rgba(255, 255, 255, 0.9);
  font-weight: 300;
}

::-webkit-input-placeholder {
  color: rgba(255, 255, 255, 0.9);
}

:-moz-placeholder {
  color: rgba(255, 255, 255, 0.9);
}

:-moz-placeholder {
  color: rgba(255, 255, 255, 0.9);
}

:-ms-input-placeholder {
  color: rgba(255, 255, 255, 0.9);
}
</style>
