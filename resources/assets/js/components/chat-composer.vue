<template>
  <div class="chat-composer">
  
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control"  @keyup.enter="sendMessage"  placeholder="start typing your message here ..." v-model="messageText">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button" @click="sendMessage">Send <i class="fa fa-paper-plane"></i></button>
                    </span>
                </div>
            </div>

        </div>

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
        }
    }
  
}
</script>


<style scoped>

</style>
