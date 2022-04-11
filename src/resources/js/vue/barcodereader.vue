<script>
    import { ref } from "vue";
    import { StreamBarcodeReader } from 'vue-barcode-reader';
    // console.log('test');
    
    export default {
        name: 'barcode-reader', // Name used for HTML tag
        components: {
            StreamBarcodeReader
        },
        // methods: {
        //     onLoaded() {
        //         console.log('loaded');
        //     }
        // }
    }

    // function onDecode(text) {
    //     console.log('decoded');
    // }
        

    // const onLoaded = () => {
    //     console.log("loaded");
    // };
    
</script>

<template>
    Barcode Reader
    <StreamBarcodeReader @loaded="console.log('loaded');"></StreamBarcodeReader>
</template>
