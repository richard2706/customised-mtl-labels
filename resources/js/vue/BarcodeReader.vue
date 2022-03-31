<script>
    import { StreamBarcodeReader } from 'vue-barcode-reader';
    console.log('test');
    
    export default {
        components: {
            StreamBarcodeReader
        },
        methods: {
            onLoaded() {
                console.log('loaded')
            },
            onDecode(barcode) {
                console.log(barcode);
            }
        }
    }
</script>

<template>
    <p>Barcode Reader</p>
    <StreamBarcodeReader @loaded="onLoaded" @decode="onDecode"></StreamBarcodeReader>
</template>
