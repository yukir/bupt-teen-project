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
            <input type="checkbox" class="filled-in" :id="'sign-out-' + applicationId" v-model="isSignedOut" @change="signedOutButtonAction" />
            <label :for="'sign-out-' + applicationId"></label>
        </div>
        <a class="action-button hide-on-med-and-up" href="#!">批准申请</a>
        <a class="action-button hide-on-med-and-up" href="#!" @click="signedInLinkAction" >标记为已签到</a>
        <a class="action-button hide-on-med-and-up" href="#!" @click="signedOutLinkAction" >标记为已签退</a>
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
                    self.isSignedIn = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        signedOutButtonAction: function () {
            var self = this;
            if (this.isSignedOut) {
                axios.get(this.signOutUrl)
                .then(function (response) {
                    self.isSignedOut = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        signedInLinkAction: function () {
            var self = this;
            if (!this.isSignedIn) {
                axios.get(this.signInUrl)
                .then(function (response) {
                    self.isSignedIn = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        signedOutLinkAction: function () {
            var self = this;
            if (!this.isSignedOut) {
                axios.get(this.signOutUrl)
                .then(function (response) {
                    self.isSignedOut = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
}
</script>
