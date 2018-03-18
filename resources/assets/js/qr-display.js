Vue.component('qr-display', require('./components/QRDisplay.vue'));

const app = new Vue({
    el: '#app',
    props: {
        value: String
    }
});