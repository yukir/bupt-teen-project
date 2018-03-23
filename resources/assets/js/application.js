/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('application-card', require('./components/ApplicationCard.vue'));

const app = new Vue({
    el: '#application-list'
});

$(document).ready(() => {
    $(document).scroll(() => {
        $("#list-title-hover").width($('#list-title').width());
        if ($(window).scrollTop() >= $('#list-title').offset().top) {
            $("#list-title-hover").removeClass('hide');
        } else {
            $("#list-title-hover").addClass('hide');
        }
    })
    $('.tooltipped').tooltip({
        enterDelay: 1,
        position: "right"
    });
})