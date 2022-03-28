require('./bootstrap');

import { createApp } from 'vue'

createApp({
    data() {
        return {
            'message': 'test1'
        }
    }
}).mount('#app');
