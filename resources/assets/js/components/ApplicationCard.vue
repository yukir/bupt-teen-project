<template>
    <div class="hoverable application-list" :class="{ rejected: !isApproved }">
        <div class="user-logo">
            <avatar 
                :username="userName"
                :size="44"
                :src="userLogo"
            ></avatar>
        </div>
        <div class="">{{ userName }}</div>
        <div class="space-between"></div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'approved-' + applicationId" v-model="isApproved" />
            <label :for="'approved-' + applicationId"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'sign-in-' + applicationId" v-model="isSignedIn" @change="signedInButtonAction" />
            <label :for="'sign-in-' + applicationId"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'sign-out-' + applicationId" v-model="isSignedOut" />
            <label :for="'sign-out-' + applicationId"></label>
        </div>
        <a class="action-button hide-on-med-and-up" :href="approveUrl">批准申请</a>
        <a class="action-button hide-on-med-and-up" :href="signInUrl">标记为已签到</a>
        <a class="action-button hide-on-med-and-up" :href="signOutUrl">标记为已签退</a>
    </div>
</template>

<script>
Vue.component('avatar', require('./Avatar.vue'));

export default {
    props: {
        isApproved: Boolean, 
        isSignedIn: Boolean,
        isSignedOut: Boolean,
        userLogo: String, 
        userName: String, 
        activityId: String,
        applicationId: String, 
        approveUrl: String, 
        signInUrl: String, 
        signOutUrl: String
    },
    methods: {
        signedInButtonAction: function () {
            var self = this;
            if (this.isSignedIn) {
                axios.get(this.signInUrl)
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
}
</script>
