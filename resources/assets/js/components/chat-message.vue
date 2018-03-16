<template>
    <div class="chat-message">
        <small>{{message.user}} :</small>
        <p>{{message.message}}</p>
        
    </div>

</template>


<script>
export default {
    props:{
        message:{
            type:Object,
            default:function(){
                return {message:'',user:''};
             }
        }
    }
}
</script>


<style scoped>

</style>
