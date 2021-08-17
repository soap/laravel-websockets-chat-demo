<template>
    <div>
        <div class="flex rounded-full" v-bind:class="classObject">
            <span
                class="flex items-end h-auto p-1 px-1 ml-1 text-xs font-normal text-gray-200 bg-gray-900"
                style="font-size: 10px"
            >
                {{ message.user.name }}: {{ message.content }}
                <span class="pl-1 text-gray-400" style="font-size: 8px">
                    {{ moment(message.created_time).format('hh:mm') }}
                </span>
            </span>
        </div>
    </div>
</template>

<script>
import { usePage } from "@inertiajs/inertia-vue3";

export default {
    props: ["message"],
    
    created: function () {
        this.moment = require('moment');
    },
    
    data: function () {
        return {
            isMine: this.message.user_id == usePage().props.value.auth.user.id
        };
    },
    
    methods: {
    },
    computed: {
        humanTime() {
            return moment(this.message.create_at).format('hh:mm');
        },
        classObject() {
            return {
                "justify-start": !this.isMine,
                "justify-end pr-2 pl-10": this.isMine,
            };
        },
    },
};
</script>
