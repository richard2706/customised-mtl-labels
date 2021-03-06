require('./bootstrap');

import { createApp } from 'vue'
import BarcodeReader from './vue/BarcodeReader';

createApp({
    components: {
        BarcodeReader
    },
    data() {
        return {
            scannedBarcode: -1,
            scannerLoaded: false
        }
    }
}).mount('#app');
