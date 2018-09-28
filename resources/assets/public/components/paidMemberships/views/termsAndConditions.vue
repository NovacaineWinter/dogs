		
<template>
	<div>
		<section class="section">
			<div class="container">
				<h1 class="title has-text-centered">Terms And Conditions</h1>

				<p>
                    We try our very best to make you and your dog very happy. We source toys and treats for you to give to your dog every month.
				</p>
                <h1 class="title">Subscription</h1>
                <p>The rolling monthly subscription is no-commitment. You are free to cancel your plan at any time, if you have paid for a box to be delivered, you will still get your delivery but your plan won't renew.</p>
                <p>We deliver all the boxes at the same time, this means that there might be a little bit of a wait when you first sign up for a box to receive your first delivery, but you will know that the boxes will be coming around the same time each month. You can check when you are due a delivery in the dashboard (log in to see) and we will send you a reminder email when we dipatch your box</p>

                <h1 class="title">
                    General Caution
                </h1>
                <p>We try our very best to give you the most suitable toys and treats for your size of dog, but it is at your ultimate discretion if you are to give the toys and treats to your dog, you know your dog the best. As usual, it is important to supervise your dog at all times when they are playing with toys and eating treats to prevent any mishaps. If you think a toy or treat is inappropriate for your dog, don't give it to them and get in touch with us.</p>
			</div>
		</section>
	</div>
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
        
        mounted() {         
            setTimeout( () => { window.scrollTo(0, 0);}, 10);
        },
/*

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
    @import '~sass/variables';

</style>

		