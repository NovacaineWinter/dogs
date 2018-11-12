		
<template>
 	<tr class="invoiceRow">
        <td v-text="dateString"></td>
        <td v-text="amountString"></td>
        <td>
        	<a :href="invoice.pdf_link">
        		<div class="button is-primary is-outlined is-hoverable">View</div>
        	</a>
        </td>
    </tr>
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
    	/*
        mounted() {        	
            setTimeout(() => {
                window.scrollTo(0,0);
            }, 100);     
        },

        methods:{
            myMethod(){
                console.log('my method triggered');
            },
        },
*/
        computed:{
        	amountString(){
        		return '£'+this.invoice.amount_due/100;
        	},    
        	dateString(){
        		let dateObject = new Date(Date.parse(this.invoice.created_at));
        		let months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        		return  months[dateObject.getMonth()] +' '+  dateObject.getFullYear();

        	},    	
        },

        data: function() {
		    return{
		        invoice:this.inv,		        
		      }
	    },

	    props: [
		    'inv'
	    ], 

    };
</script>



<style lang="scss">
    @import '~sass/variables';
	.invoiceRow{
		td,th{
			padding:5px 15px;
		}
	}
</style>

		