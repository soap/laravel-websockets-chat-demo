<template>
    <div class="w-full h-96">
        <div class="flex flex-col-reverse h-full p-2 overflw-scroll">
            <div v-for="message in messages" :key="message.id">
                <Message-Item :message="message" />
            </div>   
        </div>
    </div>    
</template>

<script>
    import MessageItem from '@/Pages/Chat/MessageItem.vue'
    export default {
        components: {
            MessageItem
        },
        props: ['messages']
    }
</script>