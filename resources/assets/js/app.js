import Axios from 'axios';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

var socket = io('http://localhost:3000');
// var socket = io('http://192.168.10.10:3000');

socket.on("test-channel:App\\Events\\EventName", function (message) {
    
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
//  */

Vue.component('chat-message', require('./components/chat-message.vue'));
Vue.component('chat-log', require('./components/chat-log.vue'));
Vue.component('chat-composer', require('./components/chat-composer.vue'));
Vue.component('chat-room',require('./components/chat-room.vue'));

const app = new Vue({
    el: '#app',
    data(){
        return {
            messages: [],
            users:{},
            rooms: {},
            user :{}
        }
       
    },
    methods:{
        addMessage:function(data){

            axios.post('/messages',data)
            .then(response => console.log(response))
            .catch(function(error){
                console.log(error);
            })
            this.messages.push(data);
        }
    },
    created(){
        //get all messages 
        axios.get('/messages').then( response => this.messages = response.data)
            .catch(error => console.log(error));
        
        //get all users 
        axios.get("/users").then(response =>  this.users = response.data)
            .catch(error => console.log(error));
        
        //get all groups 
        axios.get("/groups").then(response => this.rooms = response.data)
            .catch(error => console.log(error));

        //get user details 
        axios.get('/user').then( response => this.user = response.data)
            .catch(error => console.log(error));
        
    console.log(`${this}`);

    }
});

