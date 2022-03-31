require('./bootstrap');

import { createApp } from 'vue'
import BarcodeReader from './vue/BarcodeReader';

createApp({
    components: {
        BarcodeReader
    },
    data() {
        return {
            message: "test123"
        }
    }
}).mount('#app');
