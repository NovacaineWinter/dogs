		
<template>
        <div class="tabs is-centered">
            <ul>
                <router-link to="/" tag="li" exact><a>My Subscriptions</a></router-link>
                <router-link to="/details" tag="li" exact><a>My Details</a></router-link>
                <router-link to="/payment-methods" tag="li" exact><a>My Payment Methods</a></router-link>
                <!-- <router-link to="/history" tag="li" exact><a>History</a></router-link> -->
                <router-link to="/invoices" tag="li" exact><a>Invoices</a></router-link>
                <router-link to="/add-subscription" tag="li" exact><a>Add a new Subscription</a></router-link>
            </ul>
        </div>
   
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

        methods:{
            myMethod(){
                console.log('my method triggered');
            },
        },

        computed:{
        	someNumber(){
        		return 2+3;
        	},        	
        },

        data: function() {
		    return{
		        someDataOnThis:'',		        
		      }
	    },

	    props: [
		    'propsPassed'
	    ], */

    };
</script>



<style lang="scss">
    //@import '~sass/variables';

</style>

		