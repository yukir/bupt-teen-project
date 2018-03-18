import QrcodeVue from 'qrcode.vue';

const app = new Vue({
    el: '#qrcode',
    data: {
        value: "String",
        size: 500
    },
    template: '<qrcode-vue :value="value" :size="size"></qrcode-vue>',
    components: {
        QrcodeVue
      }
});