require('./bootstrap');

import { createApp } from 'vue'
// import barcodereader from './vue/barcodereader';

createApp({
    // components: {
    //     barcodereader
    // }
    data() {
        return {
            message: "test123"
        }
    }
}).mount('#app');
