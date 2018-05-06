<template>
        <div class="chat-message clearfix">
        <textarea name="message-to-send" id="message-to-send" @keyup.enter="sendMessage"  placeholder="start typing your message here ..." v-model="messageText" rows="3"></textarea>
        <i class="fa fa-file-o"></i> 
        <i class="fa fa-file-image-o"></i>       
        <button  @click="sendMessage">Send</button>
        </div>
</template>


<script>

export default {

    
    data(){
        return{
            messageText: ''
        }
    },
    methods:{
        sendMessage: function(){
            this.$emit('messagesent',{
                message :this.messageText,
                user:"static user"
            });
            this.messageText = '';
        },
          send: function() {
      let data = {
        text: this.text,
        sender: this.name
      };
      socket.emit("textMessage", data, this.room);
      this.messages.push(data);
      this.text = "";
      this.isTyping = false;
    }
    }
  
}
</script>


<style scoped>

</style>
