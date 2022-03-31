require('./bootstrap');

import { createApp } from 'vue'
import BarcodeReader from './vue/BarcodeReader';

createApp({
    components: {
        BarcodeReader
    }
}).mount('#app');
