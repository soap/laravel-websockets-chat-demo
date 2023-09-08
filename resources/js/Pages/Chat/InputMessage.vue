<template>
 <div class="relative h-10 m-1">
     <div style="border-top: 1px solide #e6e6e6" class="grid grid-cols-6">
        <input
            type="text"
            v-model="message"
            @keyup.enter="sendMessage()"
            placeholder="Say something"
            class="p-1 cols-span-5 outline-home"
        />
        <button
            @click="sendMessage()"
            class="p-1 mt-1 text-white bg-gray-500 rounded place-self-end hover:bg-blue-700"
        >
        Send
        </button>
     </div>
</div>
</template>

<script>
    import Input from '../../Jetstream/Input.vue'
    import axios from 'axios'
    export default {
    components: { Input },
        props: ['room'],
        data: function () {
            return {
                message: ''
            }
        },
        methods: {
            sendMessage() {
                if (this.message == '') {
                    return;
                }
                axios.post('/chat/room/'+this.room.id + '/message', {
                    message: this.message
                })
                .then( response => {
                    if (response.status == 201) {
                        this.message = '';  // empty message
                        this.$emit('messagesent'); // update parent component for succussful
                    }
                })
                .catch( error => {
                    console.log( error );
                })
            }
        }
    }
</script>
