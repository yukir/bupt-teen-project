Vue.component('qr-code', require('./components/QR.vue'));

var app = new Vue({
    el: '#app',
    methods: {
        getQRFrameSize: function () {
            var qrFrame = document.querySelector('#qr-frame');
            var height = Number(window.getComputedStyle(qrFrame).getPropertyValue('height').slice(0, -2));
            var width = Number(window.getComputedStyle(qrFrame).getPropertyValue('width').slice(0, -2));
            return Math.min(height, width);
        },
        toggleFullScreen: function (event) {
            function launchFullscreen(element) {
                if(element.requestFullscreen) {
                    element.requestFullscreen();
                } else if(element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if(element.msRequestFullscreen){
                    element.msRequestFullscreen();
                } else if(element.webkitRequestFullscreen) {
                    element.webkitRequestFullScreen();
                }
              }
            function exitFullscreen() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                }
              }
            var fullscreenElement =
                document.fullscreenElement ||
                document.mozFullScreenElement ||
                document.webkitFullscreenElement;

            if (fullscreenElement == null) {
                event.target.innerHTML = "退出全屏";
                launchFullscreen(document.body);
                var self = this;
                self.$refs.qrcode.size = self.getQRFrameSize();
                //alert(self.getQRFrameSize());
                self.$nextTick(function () {
                    self.$refs.qrcode.$nextTick(function () {
                        //alert(this.size);
                    });
                });
            } else {
                event.target.innerHTML = "全屏显示";
                exitFullscreen();
            }
        }
    }
});