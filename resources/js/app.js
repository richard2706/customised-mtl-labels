require('./bootstrap');

import { createApp } from 'vue'
import barcodereader from './vue/barcodereader';

createApp({
    components: {
        barcodereader
    }
}).mount('#app');
