<template>

    <div>
        <chat-header></chat-header>
        <div class="chat-history">
            <ul>
                <chat-message :v-for="message in messages" :message="message"></chat-message>
            </ul>
        </div>
    </div>



</template>


<script>
export default {
  data() {
    return {
      rooms: [
        "General",
      ],
      isTyping: false,
      messages: [
      {
        text:'some text',
        sender:"iyad"
      },
      {
        text:'some text',
        sender:"iyad"
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
        sender: this.name
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



</style>
