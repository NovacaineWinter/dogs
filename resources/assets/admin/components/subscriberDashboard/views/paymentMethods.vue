		
<template>
    <div>
        <dash-tabs></dash-tabs>
        <h1 class="title">Payment Method</h1> 
        <payment-card-row v-for="card in $root.user.my_payment_methods" :card="card" :key="card.id"></payment-card-row>
        <div class="button is-info" :class="{'is-loading':loadingNewCardButton}" v-show="!errorInLoadingStripe" @click="addNewCard">+ Add New Card</div>
    </div>
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {

        mounted() {        	
            setTimeout( () => { window.scrollTo(0, 0);}, 10);

            axios.get('/api/get-stripe-public-key')      
                .then(response => {

                    this.stripeHandler = StripeCheckout.configure({
                        key: response.data,
                        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                        locale: 'auto',
                        token: function(context,token) {
                            // You can access the token ID with `token.id`.
                            // Get the token ID to your server-side code for use.
                            
                            this.addCardToAccount(token);
                        }.bind(this,'this')
                    });
                    

                })
                
            
                .catch(error => {
                    this.errorInLoadingStripe = true;
                });
            
            

        },

        methods:{
            addCardToAccount(token){
                this.loadingNewCardButton = false;
                console.log(token);
            },

            addNewCard(){
                this.loadingNewCardButton = true;
                this.stripeHandler.open({
                    name: 'Toys and Treats',
                    panelLabel:'Add New Card',
                    email: this.$root.user.email,
                    allowRememberMe:false,
                  });       
            }
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
		        stripeHandler:{},	
                errorInLoadingStripe:false,	 
                loadingNewCardButton:false       
		      }
	    },
/*
	    props: [
		    'propsPassed'
	    ], */

    };
</script>



<style lang="scss">
    //@import '~sass/variables';

</style>

		