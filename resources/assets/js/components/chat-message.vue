<template>
    <div class="chat-message">
        <small>{{message.sender}} :</small>
        <p>{{message.text}}</p>
        
    </div>

</template>


<script>
export default {
    props:{
        message:{
            type:Object,
            default:function(){
                return {sender:'',text:''};
             }
        }
    }
}
</script>


<style scoped>

</style>
