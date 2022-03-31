<script>
    import { ref } from "vue";
    import { StreamBarcodeReader } from 'vue-barcode-reader';
    console.log('test');
    
    export default {
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
    <p>Barcode Reader</p>
    <StreamBarcodeReader @loaded="console.log('loaded');"></StreamBarcodeReader>
</template>
