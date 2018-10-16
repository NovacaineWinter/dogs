		
<template>

	<div class="modal cancelSubModal">
		<div class="modal-background" @click="$emit('closeModal')"></div>

		<div class="modal-content box" v-if="!showErrorMessage">
			<h1 class="title">Are you sure you want to cancel?</h1>
			<span v-show="reasonError" class="is-danger">Required</span>
			<div class="field">
				<div class="control">
					<div class="select" :class="{'is-danger':reasonError}">						
						<select v-model="selectedReason" class="fullwidthselect">
						  	<option disabled value="">Please select a reason...</option>
							<option v-for="reason in reasons" :value="reason.id">{{reason.name}}</option>
						</select>					
					</div>
				</div>
			</div>
			<div class="section is-right">
				<div class="button is-outlined is-danger" :class="{'is-loading':cancelLoading}" @click="cancelSubscription">Cancel my Subscription</div>
				<div class="button is-primary" @click="$emit('closeModal')">Back</div>
			</div>
		</div>

		<div class="modal-content box" v-if="showErrorMessage">
			<h1 class="title">Something went wrong</h1>
			<p class="subtitle">Please try again, if the problem happens again, please contact us</p>
			<div class="button is-danger is-outlined is-right" @click="closeErrorMessage">Ok</div>			
		</div>
		<button class="modal-close is-large" aria-label="close" @click="$emit('closeModal')"></button>
	</div>
	
	
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {

        mounted() {        	
            
            axios.get('/api/cancellationReasons')      
            .then(response => {this.reasons = response.data;})

            .catch(error => {alert(repsponse.data);});
        },

        methods:{
            cancelSubscription(){
            	if(this.selectedReason==''){
            		this.reasonError=true;
            	}else{
            		this.reasonError=false;
            		this.cancelLoading=true;

    				axios.post('/api/cancelSubscription',{sub_id:this.sub.id,reason_id:this.selectedReason})      
    					.then(response => {this.$emit('subCancelled',this.sub);})
    		
    					.catch(error => {this.showErrorMessage=true;});            		       
            	}
            },

            closeErrorMessage(){
            	this.showErrorMessage=false;
            	this.$emit('closeModal');
            }
        },

  
        data: function() {
		    return{
				reasons:{},		
				selectedReason:'',
				reasonError:false,
				cancelLoading:false,
				showErrorMessage:false    
		      }
	    },

	    props: [
		    'sub'
	    ], 

    };
</script>



<style lang="scss">
    @import '~sass/variables';
	.cancelSubModal{
		.field{
			.control{
				.select{
					width:100%;
					select{
						width:100%;
					}
				}				
			}
		}
		.is-right{
			.button{
				float:right;
			}
			.is-primary{
				margin:0px 20px;
			}
		}
		span.is-danger{
			color:$brand-danger;
			font-weight:bold;
			padding:10px;
			display:block;
			background-color:$brand-danger-background;
		}
	}
</style>

		