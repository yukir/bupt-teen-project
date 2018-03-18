<template>
    <div>
        <qrcode-vue :value="value"></qrcode-vue>
    </div>
</template>

<script>
import QrcodeVue from 'qrcode.vue';

export default {
    components: {
        QrcodeVue
    },
    props: {
        value: String
    }
}
</script>