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
                // somehow get barcode to go to product page
                // - submit the form on scan.blade.php?
                // - set the barcode as some global variable? (not good practice but may work)
            }
        }
    }
</script>

<template>
    <StreamBarcodeReader @loaded="onLoaded" @decode="onDecode"></StreamBarcodeReader>
</template>
