		
<template>

	<div id="gift-voucher-view">    


	    <section class="hero is-primary">
	        <div class="hero-body">
	            <div class="container">
	                <h1 class="title">Give someone a wonderful gift, Their dog will love it!</h1>
	            </div>
	        </div>
	    </section>

		<section class="section">
           <div class="container">
			<h1 class="title has-text-centered">Buy a Gift Voucher</h1>
           	<p class="subtitle has-text-centered">A Toys and Treats gift voucher makes the perfect present, You can buy a voucher for 1, 3 or 6 boxes.<br> We will email you a voucher you can give to that lucky someone!</p>


               <div class="columns voucher-options">
                  

                  <div class="column voucher-option" v-for="voucher in vouchers" :key="voucher.id" @click="selectedVoucher(voucher)">
                       	<span class="saving" v-text="voucher.discount" v-if="voucher.discount!=''"></span>
                       	<div class="card" :class="{'is-selected':voucher.id == voucherSelected.id}">
                           <header class="card-header is-horisontal-center">
                               <p class="card-header-title subtitle has-text-centered" v-text="voucher.title"></p>
                           </header>                           
                            <div class="card-content is-flex is-horisontal-center">                                
                               <img :src="voucher.img" class="is-horisontal-center" alt="plan image">
                           </div>
                           <div class="button is-outlined is-primary is-centered">Select</div>
                           <div class="card-content has-text-centered"> 
                               <p class="title" v-text="voucher.price_string"></p>
                           </div>
                           <div class="card-content has-text-centered"> 
                               <p v-html="voucher.description"></p>
                           </div>
                       	</div>
                   </div>


               </div>


           </div>
       </section>



       <div id="giftloadingscreen" v-show="showLoading" @click="showLoading=false">
	        <div class="container">
	            <div class="columns">
	                <div class="column blankcolumn">&nbsp;</div>
	                <div class="column">                                
	                    <h1 class="title has-text-centered">Loading...</h1>
	                    <div class="button is-loading is-primary is-outlined is-large">&nbsp;</div>
	                </div>
	                <div class="column blankcolumn">&nbsp;</div>
	            </div>
	        </div>
	    </div> 




	    <div id="errorScreen" v-show="errorScreen" @click="errorScreen=false">
            <div class="container">
                <div class="columns">
                    <div class="column blankcolumn">&nbsp;</div>
                    <div class="column">                                
                        <h1 class="title has-text-centered">There was a problem...</h1>
                        <p class="subtitle has-text-centered" v-text="errorMessage"></p>
                        <router-link to="/contact-us" tag="div" class="button is-primary is-outlined is-large">Contact Us</router-link>
                    </div>
                    <div class="column blankcolumn">&nbsp;</div>
                </div>
            </div>
        </div>


	    <div id="successScreen" v-show="successScreen" @click="successScreen=false">
            <div class="container">
                <div class="columns">
                    <div class="column blankcolumn">&nbsp;</div>
                    <div class="column">                                
                        <h1 class="title has-text-centered">Purchase Successful</h1>
                        <p class="subtitle has-text-centered">Thanks very much for buying a Toys and Treats gift voucher, We have emailed you a link to download your voucher, the code is : <span v-text="voucherCode"></span>. You can view your voucher below</p>
                        <a :href="voucherURL" class="button is-primary is-outlined is-large">View Voucher</a>
                        <router-link to="/contact-us" tag="div" class="button is-primary is-outlined is-large">Contact Us</router-link>
                    </div>
                    <div class="column blankcolumn">&nbsp;</div>
                </div>
            </div>
        </div>



	</div>

</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
    	
        mounted() {        	
            setTimeout(() => {
                window.scrollTo(0,0);
            }, 100);     

            axios.get('/api/voucher-options')      
            	.then(response => {this.vouchers = response.data})
            
            	.catch(error => {alert(error.data);});
            


            axios.get('/api/get-stripe-public-key')      
                .then(response => {

                    this.stripeHandler = StripeCheckout.configure({
                        key: response.data,
                        image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
                        locale: 'auto',
                        token: function(context,token) {
                            // You can access the token ID with `token.id`.
                            // Get the token ID to your server-side code for use.
                            
                            this.tokenGenerated(token);                            
                        }.bind(this,'this'),

                        opened: function() {
						  	this.showLoading = false;
						}.bind(this,'this'),


						closed: function() {
						  	this.showLoading = false;
						}.bind(this,'this'),
                    });
                    

                })
                .catch(error => {
                    this.showErrorScreen = true;
                });
            
        },

        methods:{
            selectedVoucher(voucher){
           		this.showLoading = true;
               	this.voucherSelected = voucher;

                this.stripeHandler.open({
                    name: voucher.title,
                    description: 'Gift Voucher',
                    currency: 'gbp',
                    amount: voucher.amount,                    
                    allowRememberMe:false,
                });           
            },
            tokenGenerated(token){
            	this.showLoading = true;
            	
            	axios.post('/api/buy-giftvoucher',{
	            		voucher:this.voucherSelected.id,
	            		token:token,
	            	})      
            		.then(response => {
            			if(response.data.status){
            				this.showLoading = false;
            				this.successScreen = true;  
            				this.voucherCode = response.data.vouchercode;          				
            			}else{
            				this.errorScreen = true;
            				this.errorMessage = response.data.message            				
            			}
            		})
            	
            		.catch(error => {
            			this.errorScreen = true;
            		});
            	
            	
            },

        },

        computed:{
        	voucherURL(){
        		return '/voucher-code/?code='+this.voucherCode;
        	},        	
        },

        data: function() {
		    return{
		        vouchers:{},
		        voucherSelected:{},
		        stripeHandler:'',
		        showLoading:false,
		        errorScreen:false,
		        successScreen:false,
		        errorMessage:'There was an error while processing your transaction, please contact us',
		        voucherCode:''
		      }
	    },
/*
	    props: [
		    'propsPassed'
	    ], */

    };
</script>



<style lang="scss">
    @import '~sass/variables';
	#gift-voucher-view{
		
		padding-bottom:30vh;

		.saving{
			position: absolute;
			top: 11px;
			right: 11px;
			background-color: #00d1b2;
			padding: 16px 10px;
			border-radius: 50%;
			color: #fafafa;
			font-weight: bold;
			z-index: 1;
			width: 56px;
			text-align: center;
		}

		.is-horisontal-center{
	            justify-content: center;
	    }

	    .button.is-centered{
            margin-left:42%;
        }

		.voucher-option{
			cursor:pointer;
			position:relative;
		}
        .voucher-option .card:hover{
        	box-shadow:0px 0px 20px #00d1b2;
			background-color:#ccf5ef;
	    }

	}


    #giftloadingscreen{
        position:fixed;
        width:100vw;
        height:100vh;
        top:0px;
        left:0px;
        padding:0px;
        margin:0px;
        background-color:rgba(255,255,255,0.7);
        z-index:100;

        .container{
            display: flex;
            align-items: center;
            justify-content: center;            
        }

        .columns{
            margin-top: 20%;
            padding: 5%;
            border: 1px solid $text-dark;
            background-color: #fff;
        }
        .button{
            width:100%;
        }

    } 


    #errorScreen,#successScreen{
        position:fixed;
        width:100vw;
        height:100vh;
        top:0px;
        left:0px;
        padding:0px;
        margin:0px;
        background-color:rgba(255,255,255,0.7);
        z-index:100;

        .container{
            display: flex;
            align-items: center;
            justify-content: center;            
        }

        .columns{
            margin-top: 20%;
            padding: 5%;
            border: 1px solid $text-dark;
            background-color: #fff;
        }       
        .button{
            width:100%;
            margin-top:20px;
        }

    }
</style>

