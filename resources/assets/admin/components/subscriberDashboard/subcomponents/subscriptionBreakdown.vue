		
<template>
    <article class="message is-primary" v-if="sub.is_active">
        <div class="message-header">
            <p>{{sub.plan.nickname}} &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp; Delivered To {{dogName}}</p>            
        </div>
        <div class="message-body">
            <div class="columns">
                <div class="column">
                    <p v-text="sub.plan.description"></p>
                </div>
                <div class="column">
                    Next delivery will be dispatched on: 31st October
                </div>
            </div>
            
            <div class="tabs is-centered">     
                <ul>
                    <li @click="showCancelModal=true"><a>Cancel Subscription</a></li>
                    <li @click="showDogDetailModal=true"><a>Change Dog Details</a></li>
                </ul>
         </div>
        </div>
        <dog-detail-modal :sub="sub" v-show="showDogDetailModal" @detailsChanged="updatedDogDetails" @closeModal="showDogDetailModal=false"></dog-detail-modal>
        <cancel-subscription-modal :sub="sub" v-show="showCancelModal" @subCancelled="cancelPlan" @closeModal="showCancelModal=false"></cancel-subscription-modal>        
    </article>
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
    	/*
        mounted() {        	
            
            axios.get(endpoints.someEndpoint)            
                .then(handleResponse.bind('data',this))

                .catch(function (error) {
                    console.log(error);            
                });

                function handleResponse(context,response){
                    //context is an alias for 'this'
                    context.someDataOnThis = response.data;
                }
        },
        */
        methods:{
            cancelPlan(sub){
                //refresh the page 5 seconds after to allow time for the webhook to go through
                this.showCancelModal=false;
                this.$emit('cancelPlan',sub);
                //setTimeout(function(){location.reload();},5000)
            },
            updatedDogDetails(info){
                this.dogName = info.dog_name;
                this.showDogDetailModal=false;
            },
        },
/*
        computed:{
        	someNumber(){
        		return 2+3;
        	},        	
        },
*/
        data: function() {
		    return{
                showDogDetailModal:false,   
		        showCancelModal:false,	
                dogName:this.sub.dog_name	        
		      }
	    },

	    props: [
		    'sub'
	    ], 

    };
</script>



<style lang="scss">
    //@import '~sass/variables';

</style>

		