<template>
    <app-layout title="Chat">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                <Chat-Room-Selection 
                    v-if="currentRoom.id"
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomChanged="setRoom($event)"
                />
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <Message-Container :messages="messages"/>
                    <Input-Message :room="currentRoom" 
                        v-on:messagesent="getMessages()"    
                    />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout.vue'
    import MessageContainer from '@/Pages/Chat/MessageContainer.vue'
    import InputMessage from '@/Pages/Chat/InputMessage.vue'
    import ChatRoomSelection from '@/Pages/Chat/ChatRoomSelection.vue'
    import axios from 'axios'
    
    export default {
        components: {
            AppLayout,
            MessageContainer,
            ChatRoomSelection,
            InputMessage
        },
        data: function () {
            return {
                chatRooms: [],
                currentRoom: [],
                messages: []
            }

        },
        watch: {
            currentRoom() {
                this.connect();
            }    
        },
        methods: {
            connect() {
                if (this.currentRoom.id ) {
                    let vm = this;
                    this.getMessages();
                    window.Echo.private("chat." + this.currentRoom.id)
                    .listen('.message.new', e => {
                        vm.getMessages()
                    })
                }        
            },
            getRooms() {
                axios.get('/chat/rooms')
                .then(response => {
                    this.chatRooms = response.data;
                    this.setRoom(response.data[0]);    
                }).catch(error => {
                    console.log(error);
                })              
                
            },
            
            setRoom(room) {
                this.currentRoom = room;
                this.getMessages();
            },

            getMessages() {
                axios.get('/chat/room/' + this.currentRoom.id + '/messages')
                .then(response => {
                    this.messages = response.data;
                }).catch(error => {
                    console.log(error);
                })   
            }

        },
        
        created() {
            this.getRooms();
        }
    }
</script>