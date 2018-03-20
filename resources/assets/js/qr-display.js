Vue.component('qr-code', require('./components/QR.vue'));

var app = new Vue({
    el: '#app',
    methods: {
        getQRFrameSize: function () {
            var qrFrame = document.querySelector('#qr-frame');
            var height = Number(window.getComputedStyle(qrFrame).getPropertyValue('height').slice(0, -2));
            var width = Number(window.getComputedStyle(qrFrame).getPropertyValue('width').slice(0, -2));
            return Math.min(height, width);
        }
    }
});