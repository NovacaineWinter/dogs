		
<template>
	<div class="addnewsubscription">
		<dash-tabs></dash-tabs>
		<h1 class="title">Add a New Subscription To Your Account</h1>


<!-- loading scroll -->
		<div class="section isloadingscroll" v-show="loading">
			<div class="button is-loading is-large"></div>
		</div>

<!-- plans -->
		<div class="columns plan-options">

            <div class="column plancol" v-for="plan in plans" :key="plan.id" @click="selectedPlan(plan)">
               
                <div class="card" :class="{'is-selected':plan.id == planSelected.id}">
                    
                    <header class="card-header has-text-centered">
                        <p class="card-header-title subtitle" v-text="plan.title"></p>
                    </header>
                    
                    <div class="card-content is-flex" :class="plan.size">                                
                        <img :src="plan.img" class="is-horisontal-center" alt="plan image">
                    </div>
                    
                    <div class="button is-outlined is-primary is-centered">Select</div>
                    <div class="card-content has-text-centered"> 
                        <p class="title" v-text="plan.price_string"></p>
                    </div>
                    
                    <div class="card-content has-text-centered"> 
                        <p v-text="plan.description"></p>
                    </div>
                </div>

            </div>

        </div>




<!-- Dog Name -->
		<div id="dognameinput">		
			<div class="columns" v-show="showDogNameInput">                    
	            <div class="column">&nbsp;</div>
	            <div class="column field">
	                <label class="label title has-text-centered">My dog's name is</label>
	                <div class="control">
	                    <input 
	                        type="text" 
	                        class="input" 
	                        :class="{'is-danger':errors.dogName}" 
	                        @keydown="errors.dogName=false"
	                        v-model="dogName"  
	                        @keyup="dogNameInputKeyup" 
	                        placeholder="Spot....Buster....Rex....">
	                    <span class="errortext" v-show="errors.dogName">Required</span>
	                </div>
	            </div>                
	            <div class="column">&nbsp;</div>
	        </div>
		</div>




<!-- Dog Size -->
		<div id="dogsizeinput">		
			<div v-show="showDogSizeInput">
				<h2 class="title has-text-centered"> {{dogName}} is a..</h2>


				<div class="columns is-mobile sizeselectors">

				    <div class="column">                        
				        <div class="card" v-bind:class="{ 'is-selected':dogSize==1 }" @click="dogSizeSelected(1)">
				            <header class="card-header has-text-centered">
				                <p class="card-header-title subtitle">
				                    Small<br>Dog
				                </p>                                
				            </header>
				            <div class="card-image">
				                <div class="pawholder">
				                    <span class="icon smallpaw">
				                        <font-awesome-icon icon="paw" />
				                    </span> 
				                </div>
				            </div>                           
				        </div>
				    </div>

				    <div class="column">                        
				        <div class="card" v-bind:class="{ 'is-selected':dogSize==2 }" @click="dogSizeSelected(2)">
				            <header class="card-header">
				                <p class="card-header-title subtitle has-text-centered">
				                    Medium<br>Dog
				                </p>                                
				            </header>
				             <div class="card-image">
				                <div class="pawholder">
				                    <span class="icon mediumpaw">
				                        <font-awesome-icon icon="paw" />
				                    </span> 
				                </div>     
				            </div>                           
				        </div>
				    </div>

				    <div class="column">                        
				        <div class="card" v-bind:class="{ 'is-selected':dogSize==3 }" @click="dogSizeSelected(3)">
				            <header class="card-header">
				                <p class="card-header-title subtitle has-text-centered">
				                    Large<br>Dog
				                </p>                                
				            </header>
				             <div class="card-image">
				                <div class="pawholder">                                    
				                    <span class="icon largepaw">
				                        <font-awesome-icon icon="paw" />
				                    </span> 
				                    <br><br>
				                </div>
				            </div>                             
				        </div>
				    </div> 

				</div>
			</div>
		</div>



		<div class="modal" v-if="showErrorMessage">
			<div class="modal-background" @click="showErrorMessage=false"></div>
			<div class="modal-content box" v-if="showErrorMessage">
				<h1 class="title">Something went wrong</h1>
				<p class="subtitle">Please try again, if the problem happens again, please contact us</p>
				<div class="button is-danger is-outlined is-right" @click="showErrorMessage=false">Ok</div>			
			</div>
			<button class="modal-close is-large" aria-label="close" @click="showErrorMessage=false"></button>
		</div>



		<div class="modal" v-if="showErrorMessage">
			<div class="modal-background" @click="showErrorMessage=false"></div>
			<div class="modal-content box" v-if="showErrorMessage">
				<h1 class="title">New Subscription Created</h1>
				<p class="subtitle">We will bill the following card </p>

				<p class="subtitle">If this is not correct, update your payment card preferences</p>
				<router-link to="/payment-methods" tag="div" class="button is-primary is-outlined">Update Card</router-link>
				<router-link to="/" class="button is-primary is-outlined is-right">Done</router-link>			
			</div>
			<button class="modal-close is-large" aria-label="close" @click="showErrorMessage=false"></button>
		</div>


	<div id="bigpadding">&nbsp;</div>

	</div>
   
</template>

<script>

    //import endpoints from '../endpoints.js';   //relative path - beware

    export default {
    	
        mounted() {   

            setTimeout(() => {
		        window.scrollTo(0,0);
		    }, 100);

            axios.get('/api/plans')      
	            .then(response => {this.handleData(response.data)})

	            .catch(error => {});
        },

        methods:{
            selectedPlan(thePlan){
            	this.planSelected = thePlan.id
            	this.showDogNameInput=true; 
				window.scrollTo(0, 0);
				let elemn = document.getElementById("dognameinput");
				elemn.scrollIntoView({ behavior: 'smooth', block: "start" });   
            },


            handleData(data){
            	this.loading=false;
            	this.plans=data;
            },

            dogNameInputKeyup(){
            	clearTimeout(this.dogNameTimeout)
            	setTimeout(() => {
            		if(this.dogName != ''){
            			this.showDogSizeInput = true;
						let elemn = document.getElementById("dogsizeinput");
						elemn.scrollIntoView({ behavior: 'smooth', block: "start" });   
            		}else{
            			this.showDogSizeInput = false;
            			let elemn = document.getElementById("dognameinput");
						elemn.scrollIntoView({ behavior: 'smooth', block: "start" });
            		}
            	},1000);
            },


            dogSizeSelected(size){
            	this.dogSize = size;
            	if(this.dogSize != '' && this.dogName != '' && this.planSelected != ''){

            		axios.post('/api/add-new-subscription',
	            		{
	            			userId:this.$root.user.id,
	            			planId:this.planSelected,
	            			dogName:this.dogName,
	            			dogSize:this.dogSize
	            		})      
            			.then(response => {this.subscriptionAddedSuccessfully()})
            		
            			.catch(error => {this.showErrorMessage = true;});
            	}
            },

            subscriptionAddedSuccessfully(userData){
            	//refresh user data
            	this.$root.reloadUserData();  //beware, async

            	this.showConfirmCardModal = true;

            	
            }
        },

        data: function() {
		    return{
		        plans:{},	
		        planSelected:'',
		        loading:true,
		        dogName:'',
		        dogSize:'',
		        dogNameTimeout:'',
		        showConfirmModal:false,
		        showConfirmCardModal:false,
		        showDogNameInput:false,
		        showDogSizeInput:false,
		        showErrorMessage:false,
		        errors:{
		        	dogName:false
		        }     
		      }
	    },

    };
</script>



<style lang="scss">
    @import '~sass/variables';
	.addnewsubscription{

		.plan-options{
			.plancol{
				max-width:400px;
				margin:auto;

				.button.is-centered{
					margin-left:42%;
				}
			}
		}


		.isloadingscroll{
			.button{
				width:100%;
			}
		}

		.card{
			cursor:pointer;
		}

		.plan-options{
            .small{
                img{
                    width:30%;            
                    margin-top:20%;
                    margin-bottom:20%;
                    margin-left:35%;
                }
            }
            .medium{
                img{
                    width:50%;
                    margin-top:10%;
                    margin-bottom:10%;
                    margin-left:25%;
                }
            }
            .large{
                img{
                    width:70%;
                    margin-left:15%;
                }
            }
        }  

   

        .is-horisontal-center{
            justify-content: center;
        }



         .pawholder{
            color:#353535;
        }

        .smallpaw{
            font-size:4vw;
            margin-top:6vw;
        }
        .mediumpaw{
            font-size:8vw;        
            margin-top:6vw;
        }
        .largepaw{
            font-size:12vw;
            margin-top:6vw;
        }

        .is-selected{
            box-shadow: 0px 0px 20px #00d1b2;
            .pawholder{
                color:#00d1b2;
            }
        }
        .card-header-title{
            display:initial;
        }
        .sizeselectors{
            span.icon{
                padding-left:50%;
            }
        }
        .pawholder{
            height:14vw;
        }


		#bigpadding{
			padding-bottom:50vh;
		}

		#dogsizeinput{
			padding-top:10vh;
		}
		#dognameinput{
			padding-top:10vh;
		}
	}

</style>

		