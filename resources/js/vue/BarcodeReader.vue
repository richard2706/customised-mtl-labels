<script>
    import { StreamBarcodeReader } from 'vue-barcode-reader';
    
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
                this.$root.scannedBarcode = barcode
                window.location.href = '/product/' + barcode;
            }
        }
    }
</script>

<template>
    <StreamBarcodeReader @loaded="onLoaded" @decode="onDecode"></StreamBarcodeReader>
</template>
