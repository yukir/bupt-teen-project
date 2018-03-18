<template>
    <div class="hoverable application-list" :class="{ rejected: !isApproved }">
        <div class="user-logo">
            <avatar 
                :username="userName"
                :size="44"
                :src="userLogo"
            ></avatar>
        </div>
        <div class="user-name">{{ userName }}</div>
        <div class="application-status-light" :class="{ on: isApproved }"></div>
        <div class="application-status-light" :class="{ on: isSignedIn }"></div>
        <div class="application-status-light" :class="{ on: isSignedOut }"></div>
        <div class="space-between"></div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'approved-' + applicationId" v-model="isApproved" @change="updateApplication" />
            <label :for="'approved-' + applicationId"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'sign-in-' + applicationId" v-model="isSignedIn" @change="updateApplication" />
            <label :for="'sign-in-' + applicationId"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'sign-out-' + applicationId" v-model="isSignedOut" @change="updateApplication" />
            <label :for="'sign-out-' + applicationId"></label>
        </div>
        <a v-if="isApproved" class="action-button hide-on-med-and-up" href="#!" @click="approveLinkAction">撤销批准</a>
        <a v-else class="action-button hide-on-med-and-up" href="#!" @click="approveLinkAction">批准申请</a>
        <a v-if="isSignedIn" class="action-button hide-on-med-and-up" href="#!" @click="signedInLinkAction" >标记为未签到</a>
        <a v-else class="action-button hide-on-med-and-up" href="#!" @click="signedInLinkAction" >标记为已签到</a>
        <a v-if="isSignedOut" class="action-button hide-on-med-and-up" href="#!" @click="signedOutLinkAction" >标记为未签退</a>
        <a v-else class="action-button hide-on-med-and-up" href="#!" @click="signedOutLinkAction" >标记为已签退</a>
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
        approveLinkAction: function () {
            this.isApproved = !this.isApproved;
            this.updateApplication();
        },
        signedInLinkAction: function () {
            this.isSignedIn = !this.isSignedIn;
            this.updateApplication();
        },
        signedOutLinkAction: function () {
            this.isSignedOut = !this.isSignedOut;
            this.updateApplication();
        },
        updateApplication: function () {
            var self = this;
            axios.patch(self.approveUrl, {
                'status': self.isApproved,
                'sign_in': self.isSignedIn,
                'sign_out': self.isSignedOut
            }).then(function (respond) {
                self.isApproved = respond.data.status;
                self.isSignedIn = respond.data.sign_in;
                self.isSignedOut = respond.data.sign_out;
            })
        }
    }
}
</script>
