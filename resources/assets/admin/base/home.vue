		
<template>
    <div>  
        <div v-if="$root.user.active_notifications.length!=0">
            <notification-banner v-for="notif in $root.user.active_notifications" :key="notif.id"></notification-banner>
        </div>
        <dash-tabs></dash-tabs>
        <h1 class="title">Account Overview</h1>

        <div v-if="$root.user.pending_subscriptions.length!=0">
            <h2 class="subtitle">Your subscription is currently being activated...</h2>
            <div class="button is-outlined is-loading is-primary"></div>
        </div>
        
        <div v-if="$root.user.active_subscriptions.length!=0">
            <h2 class="subtitle">My Active Subscriptions</h2>
            <subscription-info @cancelPlan="removeSub" v-for="sub in $root.user.active_subscriptions" :sub="sub" :key="sub.id"></subscription-info>
        </div>

        <div v-if="$root.user.active_subscriptions.length==0 && $root.user.pending_subscriptions.length==0">
            <h2 class="subtitle">You have no active subscriptions - why not take one out?</h2>
            <router-link to="/add-subscription" tag="div" class="button is-primary is-outlined">Add New Subscription</router-link>
        </div>

    </div>

</template>

<script>
    export default {
        mounted() {
            setTimeout(() => {
		        window.scrollTo(0,0);
		    }, 100);

            this.checkForPendingSubscriptions();
        },        

        methods:{
            refreshData(){
                if(this.needToReload){
                    this.$root.reloadUserData();
                    this.manageResponse();
                }                
            },

            checkForPendingSubscriptions(){
                clearTimeout(this.reloadInterval);                
                if(this.$root.user.pending_subscriptions.length!=0){                    
                    this.needToReload = true;
 
                    this.reloadInterval = setTimeout(function(){
                        this.refreshData();
                    }.bind(this),2500);

                }
            },

            manageResponse(data){

                if(this.$root.user.pending_subscriptions.length==0){
                    this.needToReload=false;
                    clearTimeout(this.reloadInterval);
                }else{
                    //go again
                    clearTimeout(this.reloadInterval);
                    this.reloadInterval = setTimeout(function(){
                        this.refreshData();
                    }.bind(this),2500);
                }
            },
            removeSub(sub){
                //had a way of doing this with lodash, decided to just pull in a refreshed load of data instead
                //this.$root.user.active_subscriptions = _.reject(this.$root.user.active_subscriptions,{id:sub.id});
                this.$root.reloadUserData();
            }
        },

        data: function() {
		    return{
                reloadInterval:'',
                needToReload:false		        
		      }
	    },
    };
</script>



<style lang="scss">
	@import '~sass/variables';

</style>

		