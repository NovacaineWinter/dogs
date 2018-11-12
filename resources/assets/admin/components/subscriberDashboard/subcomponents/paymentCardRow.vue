		
<template>
	<div class="columns paymentcardrow" :class="{'is-default-card':card.default}">
		<div class="column">
			Type:{{card.brand}}
		</div>
		<div class="column">
			Number: **** **** **** {{card.lastFour}}
		</div>
		<div class="column">
			Exp: {{card.exp_month}}/{{card.exp_year}}
		</div>
		<div class="column">
			<span v-if="card.default">Default Card</span>
			<div class="button is-primary is-outlined" @click="makeCardPrimary" v-else>Make Default</div>
		</div>
		<div class="column">
			<div v-if="!card.default" class="button is-danger is-outlined" @click="deleteCard">Delete</div>
		</div>
	</div>
   
</template>

<script>

    export default {

        methods:{

            deleteCard(){
                axios.post('/api/delete-payment-card',
                	{
	                	userId:this.$root.user.id,
	                	cardId:this.card.id
	                })      
                	.then(response => {
                		this.$root.reloadUserData();
                	})
                
                	.catch(error => {}); 
            },


            makeCardPrimary(){
                axios.post('/api/make-payment-card-primary',
                	{
	                	userId:this.$root.user.id,
	                	cardId:this.card.id
	                })      
                	.then(response => {
                		this.$root.reloadUserData();
                	})
                
                	.catch(error => {}); 
            },
        },

	    props: [
		    'card'
	    ], 

    };
</script>



<style lang="scss">
    @import '~sass/variables';
	.card-detail-row{
		.is-default-card{
			background-color:$brand-success;
		}		

	}
	.paymentcardrow{
		border:1px solid $text-dark;
	}
</style>

		