import Axios from 'axios';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/ExampleComponent.vue'));
Vue.component('chat-message', require('./components/chat-message.vue'));
Vue.component('chat-log', require('./components/chat-log.vue'));
Vue.component('chat-composer', require('./components/chat-composer.vue'));

const app = new Vue({
    el: '#app',
    data(){
        return {
            messages: [
                {
                    message: "Hey!",
                    user: "iyad"
                },
                {
                    message: "hello there!",
                    user: "mona"
                }
            ] 
        }
       
    },
    methods:{
        addMessage:function(data){

            axios.post('/messages',data)
            .then(respone => console.log(respone))
            .catch(function(error){
                console.log(error);
            })
            this.messages.push(data);
        }
    },
    created(){
        axios.get('/messages')
        .then( response => this.messages = response.data)
        .catch(error => console.log(error));
        ;
    }
});
