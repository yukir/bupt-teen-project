<template>
    <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue>
</template>
<script>
import QrcodeVue from 'qrcode.vue';

export default {
    data() {
        return {
        value: 'Please wait'
        }
    },
    props: {
        size: Number,
        src: String
    },
    components: {
        QrcodeVue
    },
    mounted: function () {
        this.updateQR();
        setInterval(() => {
            this.updateQR();
        }, 10000);
    },
    methods: {
        updateQR: function () {
            var self = this;
            axios.get(this.src)
            .then(function (respond) {
                self.value = respond.data;
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>