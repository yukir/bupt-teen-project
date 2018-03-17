<template>
    <div class="hoverable application-list" :class="{ rejected: !isApproved }">
        <div class="user-logo">
            <img :src="userLogo" alt="" class="responsive-img circle">
        </div>
        <div class="">{{ userName }}</div>
        <div class="space-between"></div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'approved-' + applicationID" v-model="isApproved" />
            <label :for="'approved-' + applicationID"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'sign-in-' + applicationID" />
            <label :for="'sign-in-' + applicationID"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" :id="'sign-out-' + applicationID" />
            <label :for="'sign-out-' + applicationID"></label>
        </div>
        <a class="action-button hide-on-med-and-up" :href="approveURL">批准申请</a>
        <a class="action-button hide-on-med-and-up" :href="signInURL">标记为已签到</a>
        <a class="action-button hide-on-med-and-up" :href="signOutURL">标记为已签退</a>
    </div>
</template>

<script>
export default {
    props: {
        isApproved: Boolean, 
        userLogo: String, 
        userName: String, 
        applicationID: String, 
        approveURL: String, 
        signInURL: String, 
        signOutURL: String
        
    }
}
</script>
