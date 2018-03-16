<template>
    <div class="chat-message">
        <small>{{message.user.name}} :</small>
        <p>{{message.message}}</p>
        
    </div>

</template>


<script>
export default {
    props:{
        message:{
            type:Object,
            default:function(){
                return null;
             }
        }
    }
}
</script>


<style scoped>

</style>
